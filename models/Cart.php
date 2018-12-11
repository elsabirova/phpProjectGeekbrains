<?php
namespace app\models;

class Cart extends Record
{
    public $id;
    public $good_id;
    public $customer_id;

    public static function getTableName() : string
    {
        return "cart";
    }
}