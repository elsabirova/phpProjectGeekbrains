<?php
namespace app\models;

class Good extends Record {
    public $id;
    public $name;
    public $description;
    public $price;
    public $img;
    public $category_id;

    /**
     * Good constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $price
     * @param $img
     * @param $category_id
     */
    public function __construct($id = null, $name = null, $description = null, $price = null, $img = null, $category_id = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img = $img;
        $this->category_id = $category_id;
    }


    public static function getTableName() : string
    {
        return "goods";
    }
}