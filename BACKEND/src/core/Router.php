<?php

namespace App\Core;

use App\Helpers\Response;

class Router
{
    protected $routes = [];
    protected $middlewares = []; // Middleware cho mỗi route

    // Định nghĩa route
    public function get($uri, $action, $middlewares = [])
    {
        $this->addRoute('GET', $uri, $action, $middlewares);
    }

    public function post($uri, $action, $middlewares = [])
    {
        $this->addRoute('POST', $uri, $action, $middlewares);
    }

    public function put($uri, $action, $middlewares = [])
    {
        $this->addRoute('PUT', $uri, $action, $middlewares);
    }

    public function delete($uri, $action, $middlewares = [])
    {
        $this->addRoute('DELETE', $uri, $action, $middlewares);
    }

    // Hàm chung để thêm route
    private function addRoute($method, $uri, $action, $middlewares = [])
    {
        $uri = trim($uri, '/');
        $this->routes[$method][$uri] = $action;
        $this->middlewares[$method][$uri] = $middlewares;
    }

    // Xử lý route
    public function dispatch()
    {
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $basePath = strtolower($basePath);
        $uri = strtolower($uri);

        if (!empty($basePath) && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method])) {
            Response::json(['message' => 'Method not allowed'], 405);
        }

        foreach ($this->routes[$method] as $route => $action) {
            $routePattern = preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', strtolower($route));
            if (preg_match('#^' . $routePattern . '$#', $uri, $matches)) {

                // Xử lý Middleware
                if (!empty($this->middlewares[$method][$route])) {
                    foreach ($this->middlewares[$method][$route] as $middleware) {
                        if (is_callable($middleware)) {
                            // Nếu middleware là function
                            $middleware();
                        } elseif (class_exists($middleware)) {
                            // Nếu middleware là class
                            $middlewareInstance = new $middleware();
                            $middlewareInstance->handle();
                        } else {
                            Response::json(['message' => "Middleware không hợp lệ: $middleware"], 500);
                        }
                    }
                }

                // Controller logic
                $actionParts = explode('@', $action);
                $controllerName = $actionParts[0];
                $methodName = $actionParts[1];

                $controllerNamespace = "App\\Controllers\\" . $controllerName;

                if (class_exists($controllerNamespace)) {
                    $controller = new $controllerNamespace();

                    $params = [];
                    foreach ($matches as $key => $value) {
                        if (!is_int($key)) {
                            $params[$key] = $value;
                        }
                    }

                    call_user_func_array([$controller, $methodName], $params);
                    return;
                } else {
                    Response::json(['message' => "Controller không tồn tại: $controllerNamespace"], 404);
                }
            }
        }

        Response::json(['message' => 'Route không tìm thấy'], 404);
    }
}
