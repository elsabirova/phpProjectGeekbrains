<?php
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include ROOT_DIR . "services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$good1 = new \app\models\Good();

$user1 = new \app\models\User();

$cart1 = new \app\models\Cart();

$category1 = new \app\models\Category();
