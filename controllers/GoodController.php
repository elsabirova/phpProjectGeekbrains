<?php
namespace app\controllers;

use app\models\repositories\GoodRepository;
use app\services\Request;

class GoodController extends Controller
{
    public function actionIndex()
    {
        $goods = (new GoodRepository())->getAllRows();
        echo $this->render("catalog", ['goods' => $goods]);
    }

    public function actionCard()
    {
        $id = (new Request())->getParam('id');
        $good = (new GoodRepository())->getOneRow($id);
        echo $this->render("card", ['good' => $good]);
    }
}