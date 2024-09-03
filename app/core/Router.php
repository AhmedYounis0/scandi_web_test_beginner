<?php

namespace MVC\core;
class Router
{
    private $controller = 'ProductController';
    private $action = 'index';
    private $params = [];

    public function __construct()
    {
        $this->Url();
        $this->Render();
    }

    private function Url()
    {
        $url = explode("/",trim($_SERVER['REQUEST_URI'],"/"),3);

        if (isset($url[0]) && $url[0] != '')
        {
            $this->controller = ucfirst($url[0]) . "Controller";
        }
        if (isset($url[1]) && $url[1] != '')
        {
            $this->action = $url[1];
        }
        if (isset($url[2]) && $url[2] != '')
        {
            $this->params = explode("/",$url[2]);
        }
        return $this;
    }

    private function Render()
    {
        $controller = "MVC\\controllers\\" . $this->controller;

        if (class_exists($controller))
        {
            if (method_exists($controller, $this->action))
            {
                call_user_func_array([new $controller, $this->action], $this->params);
            } else {
                echo 'undefined action';
            }
        } else {
            echo 'controller not found';
        }

    }

}