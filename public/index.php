<?php
require_once 'autoload.php';

use App\Router\Router;

$router = new Router();
$router->handleRequest();
