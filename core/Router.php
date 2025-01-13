<?php

class Router
{
    protected $routes = [];
    protected $middlewares = []; // Middleware cho mỗi route

    // Định nghĩa route
    public function get($uri, $action, $middlewares = [])
    {
        $uri = trim($uri, '/');
        $this->routes['GET'][$uri] = $action;
        $this->middlewares['GET'][$uri] = $middlewares;
    }

    public function post($uri, $action, $middlewares = [])
    {
        $uri = trim($uri, '/');
        $this->routes['POST'][$uri] = $action;
        $this->middlewares['POST'][$uri] = $middlewares;
    }

    // Xử lý route
    public function dispatch()
    {
        // Lấy base path (thư mục gốc của ứng dụng)
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Chuyển basePath và URI thành chữ thường để tránh lỗi phân biệt hoa thường
        $basePath = strtolower($basePath);
        $uri = strtolower($uri);

        // Kiểm tra và loại bỏ base path khỏi URI
        if (!empty($basePath) && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        // Kiểm tra route và gọi action tương ứng
        foreach ($this->routes[$method] as $route => $action) {
            $routePattern = preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', strtolower($route));
            if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {

                // Nếu là POST request, kiểm tra CSRF token
                if ($method === 'POST') {
                    // Kiểm tra CSRF Token
                    $csrfToken = Request::post('csrf');
                    if (!CSRF::validateToken($csrfToken)) {
                        Redirect::back()->notification('CSRF Token khẑng hợp lệ!', 'error')->redirect();
                    }
                }

                // Middleware
                if (!empty($this->middlewares[$method][$route])) {
                    foreach ($this->middlewares[$method][$route] as $middleware) {
                        $middlewareInstance = new $middleware();
                        $middlewareInstance->handle();
                    }
                }

                // Controller logic
                $actionParts = explode('@', $action);
                $controllerName = $actionParts[0];
                $methodName = $actionParts[1];

                $controllerPath = './app/Controllers/' . $controllerName . '.php';
                $controllerName = basename(str_replace('/', DIRECTORY_SEPARATOR, $controllerName));

                if (file_exists($controllerPath)) {
                    require_once $controllerPath;
                    $controller = new $controllerName();

                    // Lấy tham số từ route
                    $params = [];
                    foreach ($matches as $key => $value) {
                        if (!is_int($key)) {
                            $params[$key] = $value;
                        }
                    }

                    return call_user_func_array([$controller, $methodName], $params);
                } else {
                    echo "Controller not found: $controllerName";
                }
            }
        }

        // Nếu không tìm thấy route
        View::make('App/404', ['title' => '404 Not Found'], 'layout/layout-primary');
    }
}
