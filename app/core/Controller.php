<?php

namespace app\core;

use app\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    /**
     * Подключает модель к контроллеру
     * @param $name
     * @return mixed
     */
    public function loadModel($name)
    {
        $class = 'app\models\\'.ucfirst($name);
        if (class_exists($class)) {
            return new $class();
        }
    }
}