<?php
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include ROOT_DIR . "services/Autoloader.php";
require_once ROOT_DIR . "vendor/autoload.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$controllerName = $_GET['c']?:DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";
if(class_exists($controllerClass)) {
    /** @var \app\controllers\GoodController $controller */
    $controller = new $controllerClass(
        new \app\services\renderers\TwigRenderer()
    );
    $controller->runAction($actionName);
}