<?php
namespace app\controllers;

use app\base\App;

class CartController extends Controller
{
    public function actionIndex() {
        print_r(session_id());
        $cart = $this->repository->getCart();
        $amount = $this->repository->getAmount();

        echo $this->render("cart", ['cart' => $cart, 'amount' => $amount]);
    }

    public function actionAdd() {
        if(App::call()->request->isPost()) {
            $good_id = (int) App::call()->request->getParam('id_good');
            $quantity = (int) App::call()->request->getParam('quantity') ?: 1;
            $result['id'] = $this->repository->addGood($good_id, $quantity);

            echo json_encode($result);
        }
    }

    public function actionDelete() {
        if(App::call()->request->isPost()) {
            $good_id = (int) App::call()->request->getParam('id_good');
            $result['id'] = $this->repository->delete($good_id);
            echo json_encode($result);
        }
    }
}