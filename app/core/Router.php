<?php

namespace app\core;

class Router
{
    private $url;
    private $routes = [];

    function __construct()
    {
        $this->getRoutes();
        $this->getURL();
        $this->run();
    }

    function run()
    {
        // Search path from array
        foreach ($this->routes as $key => $val) {
            if ($this->url == $key) {
                $route = $val;
                break;
            }
        }

        if (isset($route)) {
            // If the path contains another dir
            $route['path'] = isset($route['path']) ? $route['path'] . '\\' : null;

            $controller = ucfirst($route['controller']) . 'Controller';
            $action 	= $route['action'] . 'Action';
            $class_path = 'app\controllers\\' . $route['path'] . $controller;

            if (class_exists($class_path)) {
                // Run
                $app = new $class_path($this->routes[$this->url]);
                $app->$action();
                $app->getView();
            } else throw new \Exception("{$controller} is not found", 404);
        } else {
            $route				 = explode('/', $this->url);
            $route['controller'] = $route[0];
            $route['action']	 = isset($route[1]) ? $route[1] : null;

            $controller = ucfirst($route['controller']) . 'Controller';
            $action 	= $route['action'] . 'Action';
            $class_path = 'app\controllers\\' . $controller;
            
            if (class_exists($class_path)) {
                // Run
                $app = new $class_path($route);
                $app->$action();
                $app->getView();
            } else throw new \Exception("{$controller} is not found", 404);
        }
    }

    private function getURL(): void
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        if (!empty($_SERVER['QUERY_STRING'])) {
            $url = explode('?', $url);
            $url = $url[0];
        }

        // Exceptions
        $arr = explode('/', $url);

        if (isset($this->routes['exceptions'])) {
            foreach ($this->routes['exceptions'] as $val) {
                if ($arr[0] == $val) {
                    $url = $arr[0];

                    if (isset($arr[1])) $this->routes[$val]['alias'] = $arr[1];
                }
            }
        }

        $this->url = $url;
    }

    private function getRoutes(): void
    {
        $this->routes = include ROOT . '/config/routes.php';
    }
}
