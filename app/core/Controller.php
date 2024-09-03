<?php

namespace MVC\core;

class Controller
{
    public function view($view, $params)
    {
        extract($params);
        require_once(VIEWS.$view.".php");
    }
}