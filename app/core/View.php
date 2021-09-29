<?php

namespace app\core;

class View
{
    public $path;
    public $view;
    public $layout = 'default';
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = 'app/views';
        $this->view = $route['controller'].'/'.$route['action'];
    }

    /**
     * Устанавливает layout
     * @param $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Устанавливает файл для отображения (папка/файл)
     * @param $view
     * @return $this
     */
    public function setViewPath($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Отображает шаблон и layout
     * @param string $title
     * @param array $vars
     */
    public function render($title = 'Title', $vars = [])
    {
        if (file_exists($path = $this->path.'/'.$this->view.'.php')) {
            extract($vars);
            ob_start();
            require_once($path);
            $content = ob_get_clean();
            require_once($this->path.'/layouts/'.$this->layout.'.php');
        } else {
            $this->setErrorCode(404);
        }
    }

    /**
     * Устанавливает ошибку страницы
     * @param $code
     */
    public static function setErrorCode($code)
    {
        http_response_code($code);
        if (file_exists($path = 'app/views/errors/'.$code.'.php')) {
            require_once($path);
        } else {
            echo $code;
        }
        exit;
    }

    /**
     * Пересылает на $url
     * @param $url
     */
    public function redirect($url)
    {
        header('Location: '.$url);
        exit;
    }

    /**
     * Преобразует массив в JSON
     * @param array $data
     * @return false|string
     */
    public function json($data = [])
    {
        return json_encode($data);
    }

    /**
     * Отдает данные в формате JSON для API-запросов
     * @param array $data
     * @return false|string
     */
    public function apiResponse($data = [])
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(200);

        return $this->json($data);
    }
}