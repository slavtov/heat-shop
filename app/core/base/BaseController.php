<?php

namespace app\core\base;

abstract class BaseController
{
    private $route;
    private $controller;
    private $view;
    private $prefix;
    private $data;
    private $meta = ['title' => 'HeatShop'];
    protected $alias;
    protected $layout = true;

    function __construct($route)
    {
        $this->route 	  = $route;
        $this->controller = $route['controller'];
        $this->view 	  = $route['action'];
        $this->alias	  = $route['alias'] ?? null;
        $this->prefix 	  = $route['prefix'] ?? null;
        $this->path 	  = isset($route['path']) ? $route['path'] . '\\' : null;
    }

    function set($data)
    {
        $this->data = $data;
    }

    function setMeta($title, $desc = null, $keywords = null)
    {
        $this->meta['title'] 	= $title . ' | HeatShop';
        $this->meta['desc'] 	= $desc;
        $this->meta['keywords'] = strtolower($keywords);
    }

    function getView()
    {
        $viewObj = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObj->render($this->data);
    }

    function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND !empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    function loadView($view, $vars = [])
    {
        extract($vars);
        require APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";
        exit();
    }

    function validate($arr)
    {
        $state = true;

        foreach ($arr as $key => $val) {
            $validate = explode('|', $val);

            foreach ($validate as $val) {
                $validation[$key][] = explode(':', $val);
            }
        }

        foreach ($validation as $key => $val) {
            foreach ($val as $v) {
                if (in_array('required', $v)) {
                    if (empty($_POST[$key])) {
                        $_SESSION['error'][] = ucfirst($key) . ' ' . 'required';
                        $state = false;
                    }
                }

                $length = strlen($_POST[$key]);

                if (in_array('min', $v) AND !empty($_POST[$key])) {
                    if ($length < $v[1]) {
                        $_SESSION['error'][] = ucfirst($key) . ' min ' . $v[1];
                        $state = false;
                    }
                }

                if (in_array('max', $v) AND !empty($_POST[$key])) {
                    if ($length > $v[1]) {
                        $_SESSION['error'][] = ucfirst($key) . ' max ' . $v[1];
                        $state = false;
                    }
                }

                if (in_array('min-num', $v) AND !empty($_POST[$key])) {
                    if ((int) $_POST[$key] < $v[1]) {
                        $_SESSION['error'][] = ucfirst($key) . ' min num ' . $v[1];
                        $state = false;
                    }
                }

                if (in_array('max-num', $v) AND !empty($_POST[$key])) {
                    if ((int) $_POST[$key] > $v[1]) {
                        $_SESSION['error'][] = ucfirst($key) . ' max num ' . $v[1];
                        $state = false;
                    }
                }
                
                if (in_array('email', $v) AND !empty($_POST[$key])) {
                    if (!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['error'][] = 'E-mail address is not validated';
                        $state = false;
                    }
                }

                if (in_array('alnum', $v) AND !empty($_POST[$key])) {
                    if (!ctype_alnum($_POST[$key])) {
                        $_SESSION['error'][] = ucfirst($key) . ' is not alnum';
                        $state = false;
                    }
                }

                if (in_array('alpha', $v) AND !empty($_POST[$key])) {
                    if (!ctype_alpha($_POST[$key])) {
                        $_SESSION['error'][] = ucfirst($key) . ' is not alpha';
                        $state = false;
                    }
                }

                if (in_array('digit', $v) AND !empty($_POST[$key])) {
                    if (!ctype_digit($_POST[$key])) {
                        $_SESSION['error'][] = ucfirst($key) . ' is not digit';
                        $state = false;
                    }
                }
            }
        }

        if ($state == false) {
            $_SESSION['form-data'] = $_POST;
            redirect();
        }
    }
}
