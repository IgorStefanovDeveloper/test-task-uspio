<?php

namespace App\Router;

use App\Controllers\IndexController;
use App\Controllers\MapRequest\SaveController;

class Router
{

    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'index';

        return match ($action) {
            'save' => SaveController::class,
            default => IndexController::class,
        };
    }
}
