<?php 

use App\Core\Router;
use App\Core\DatabaseConnection;


header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require __DIR__ . "/backend/vendor/autoload.php";

$url = filter_input(INPUT_GET, "url");
$httpMethod = filter_input(INPUT_SERVER, "REQUEST_METHOD");
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);   

$dbc = DatabaseConnection::getInstance();

$router = new Router();
$routes = require_once "./backend/Routes.php";
foreach($routes as $route){
    $router->add($route);
}

if($url === null)$url = "/";

$rout = $router->find($httpMethod, $url); 
$arguments = $rout->extractArguments($url);

$controller = $rout->getController();
$method = $rout->getMethod();
$fullController =  "\\App\\Controllers\\" . $controller . "Controller";

$controllerInstance = new $fullController($dbc);

call_user_func_array([$controllerInstance, $method], $arguments);

$data = $controllerInstance->getData();

echo json_encode($data);