<?php

namespace App\Router;

use App\Controllers\IndexController;
use App\Controllers\MapRequest\SaveController;

class Router
{

    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'index';

        $params = $_REQUEST;

        return match ($action) {
            'save' => SaveController(($params)),
           // 'help' =>
            //sale
            //updatelist
            default => new IndexController($params),
        };
    }
}
