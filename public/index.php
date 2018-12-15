<?php
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
require_once ROOT_DIR . "vendor/autoload.php";

$controllerName = $_GET['c']?:DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";
if(class_exists($controllerClass)) {
    /** @var \app\controllers\GoodController $controller */
    $controller = new $controllerClass(
        new \app\services\renderers\TwigRenderer(),
        false
    );
    $controller->runAction($actionName);
}