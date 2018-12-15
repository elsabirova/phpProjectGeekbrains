<?php
namespace app\controllers;

use app\models\Good;

class GoodController extends Controller
{
    public function actionIndex()
    {
        $goods = Good::getAllRows();
        echo $this->render("catalog", ['goods' => $goods]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $good = Good::getOneRow($id);
        echo $this->render("card", ['good' => $good]);
    }
}