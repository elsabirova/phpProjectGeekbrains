<?php
namespace app\models;

class Cart extends Record
{
    public $id;
    public $good_id;
    public $session_id;
    public $quantity;
    public $user_id;

    public function __construct($id = null, $good_id = null, $session_id = null, $quantity = null, $user_id = null) {
        $this->id = $id;
        $this->good_id = $good_id;
        $this->session_id = $session_id;
        $this->quantity = $quantity;
        $this->user_id = $user_id;
    }
}