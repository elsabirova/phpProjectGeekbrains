<?php
include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";
include ROOT_DIR . "services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$good1 = new \app\models\Good();
echo '<pre>';
print_r($good1->getOneRow(1));
print_r($good1->getAllRows());
//print_r($good1->createRow(['name'=>'Rosa','price'=>'3000','img'=>'1','category_id'=>'2']));
print_r($good1->updateRow(5, ['name'=>'Rosa2','price'=>'300']));
//print_r($good1->deleteRow(6));

$user1 = new \app\models\User();

$cart1 = new \app\models\Cart();

$category1 = new \app\models\Category();
