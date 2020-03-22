<?php

namespace app\core\base;

class View
{
    private $controller;
    private $view;
    private $layout;
    private $path;
    private $meta;

    function __construct($route, $layout = LAYOUT, $view, $meta)
    {
        $this->layout 	  = $layout;
        $this->controller = $route['controller'];
        $this->view 	  = $view;
        $this->meta 	  = $meta;
        $this->path 	  = (isset($route['path'])) ? $route['path'] : null;

        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = ($layout != LAYOUT) ? $layout : LAYOUT;
        }
    }

    function render($data)
    {
        if (is_array($data)) extract($data);

        $viewFile = APP . "/views/{$this->path}/{$this->controller}/{$this->view}.php";

        if (file_exists($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("View {$this->controller}/{$this->view} is not found", 500);
        }

        if ($this->layout !== false) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";

            if (file_exists($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new \Exception("Layout {$this->layout} is not found", 500);
            }
        } else echo $content;
    }
}
