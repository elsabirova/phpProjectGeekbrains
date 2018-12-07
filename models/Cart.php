<?php
namespace app\models;

class Cart extends Model {
    public $id;
    public $good_id;
    public $customer_id;

    public function getTableName() {
        return "cart";
    }
}