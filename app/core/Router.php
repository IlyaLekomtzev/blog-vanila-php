<?php

namespace app\core;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arRoutes = require_once('app/config/routes.php');
        foreach ($arRoutes as $key => $value) {
            $this->add($key, $value);
        }
    }

    /**
     * Преобразует и добавляет маршрут в массив
     * @param $route
     * @param $params
     */
    public function add($route, $params)
    {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /**
     * Проверяет активный маршрут
     * @return bool
     */
    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url,$matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Запускает маршрутизацию приложения
     */
    public function run()
    {
        if ($this->match()) {
            $pathController = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($pathController)) {
                $action = $this->params['action'].'Action';
                if (method_exists($pathController, $action)) {
                    $controller = new $pathController($this->params);
                    $controller->$action();
                } else {
                    View::setErrorCode(404);
                }
            } else {
                View::setErrorCode(404);
            }
        } else {
            View::setErrorCode(404);
        }
    }
}
