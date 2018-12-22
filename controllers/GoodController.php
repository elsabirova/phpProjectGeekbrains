<?php
namespace app\controllers;

use app\base\App;

class GoodController extends Controller
{
    public function actionIndex()
    {
        $goods = $this->repository->getAllRows();
        echo $this->render("login", ['goods' => $goods]);
    }

    public function actionCard()
    {
        $id = App::call()->request->getParam('id');
        $good = $this->repository->getOneRow($id);
        echo $this->render("card", ['good' => $good]);
    }
}