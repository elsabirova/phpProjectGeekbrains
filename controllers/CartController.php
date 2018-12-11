<?php
namespace app\controllers;

use app\models\Cart;

class CartController extends Controller
{
    public function actionCart()
    {
        $cart = Cart::getAllRows();
    }
}