<?php
namespace app\controllers;

use app\models\Good;

class GoodController extends Controller
{
    public function actionIndex()
    {
        $goods = Good::getAllRows();
        echo $this->renderList('good/catalog','good/catalogGoodItem', $goods);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $good = Good::getOneRow($id);

        echo $this->render('good/card', ['good' => $good]);
    }

    protected function renderList($template, $templateItem, $listItem)
    {
        $goodList = '';
        foreach ($listItem as $key => $value) {
            $goodList .= $this->renderTemplate($templateItem, ['good' => $value]);
        }

        return $this->render($template, ['goodList' => $goodList]);
    }
}