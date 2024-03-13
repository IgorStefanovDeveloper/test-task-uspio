<?php

namespace App\Router;

use App\Controllers\Controller;
use App\Controllers\ControllerInterface;
use App\Controllers\GoogleMap\HelpController;
use App\Controllers\IndexController;
use App\Controllers\MapHistory\SaveController;
use App\Controllers\MapHistory\UpdatelistController;

class Router
{

    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'index';

        $params = $_REQUEST;

        return match ($action) {
            'save' => new SaveController(),
            'help' => new HelpController(),
            'updatelist' => new UpdatelistController(),
            default => new IndexController(),
        };
    }
}
