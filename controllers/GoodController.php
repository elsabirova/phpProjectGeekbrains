<?php
namespace app\controllers;

use app\base\App;
use app\models\repositories\GoodRepository;

class GoodController extends Controller
{
    public function actionIndex()
    {
        $goods = (new GoodRepository())->getAllRows();
        echo $this->render("catalog", ['goods' => $goods]);
    }

    public function actionCard()
    {
        $id = App::call()->request->getParam('id');
        $good = (new GoodRepository())->getOneRow($id);
        echo $this->render("card", ['good' => $good]);
    }
}