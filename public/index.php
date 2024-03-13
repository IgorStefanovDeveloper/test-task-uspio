<?php
require_once 'autoload.php';

const DOT_ENV_PATH = __DIR__ . '/../.env';

use App\Helpers\DataProvider\MySQLDataProvider;
use App\Router\Router;
use App\Helpers\EnvReader;

EnvReader::readEnv(DOT_ENV_PATH);

$dataProvider  = MySQLDataProvider::getInstance(getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASSWORD'));

$params = $_REQUEST;

$router = new Router();
$handle = $router->handleRequest();
$handle($dataProvider, $params);
