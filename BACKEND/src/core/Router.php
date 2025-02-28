<?php

namespace App\Core;

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

                // Thêm use cho controller
                $controllerNamespace = "App\\Controllers\\" . $controllerName;

                if (class_exists($controllerNamespace)) {
                    $controller = new $controllerNamespace();

                    // Lấy tham số từ route
                    $params = [];
                    foreach ($matches as $key => $value) {
                        if (!is_int($key)) {
                            $params[$key] = $value;
                        }
                    }

                    call_user_func_array([$controller, $methodName], $params);
                    return;
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['controllerNamespace' => "Controller not found: $controllerNamespace"]);
                    return;
                }
            }
        }

        // Nếu không tìm thấy route
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => "Route not found"]);
    }
}
