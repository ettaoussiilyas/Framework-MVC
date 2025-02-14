<?php

namespace App\Core;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    private $dispatcher;
    protected $routes = [];

    public function __construct()
    {
        $routesPath = __DIR__ . '/../../Routes/routes.php';
        
        if (!file_exists($routesPath)) {
            throw new \Exception("Routes file not found at: " . $routesPath);
        }

        $routes = require $routesPath;
        
        if (!is_array($routes)) {
            $routes = [];
        }

        $this->routes = $routes;

        $this->dispatcher = simpleDispatcher(function(RouteCollector $r) use ($routes) {
            if (is_array($routes)) {
                foreach ($routes as $route) {
                    $r->addRoute($route['method'], $route['uri'], $route['handler']);
                }
            }
        });
    }

    private function handleMiddleware($middleware)
    {
        if (!is_array($middleware)) {
            return;
        }

        foreach ($middleware as $m) {
            $middlewareClass = "App\\Middleware\\" . ucfirst($m) . "Middleware";
            if (class_exists($middlewareClass)) {
                $instance = new $middlewareClass();
                $instance->handle();
            }
        }
    }

    public function dispatch($httpMethod, $uri)
    {
        if (empty($this->routes)) {
            throw new \Exception("No routes defined");
        }

        $uri = rawurldecode(parse_url($uri, PHP_URL_PATH));
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $httpMethod && $route['uri'] === $uri) {
                // Handle middleware if present
                if (isset($route['middleware'])) {
                    $this->handleMiddleware($route['middleware']);
                }

                // Handle the route
                [$controller, $method] = explode('@', $route['handler']);
                $controller = "App\\Controllers\\" . $controller;
                
                if (!class_exists($controller)) {
                    throw new \Exception("Controller {$controller} not found");
                }
                
                $controllerInstance = new $controller();
                return $controllerInstance->$method();
            }
        }

        throw new \Exception('Route not found');
    }

    public function get($uri, $handler)
    {
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'handler' => $handler
        ];
    }

    // Add other methods for POST, PUT, DELETE, etc.
}