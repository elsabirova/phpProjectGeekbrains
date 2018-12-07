<?php

namespace app\models;

class Good extends Model {
    public $id;
    public $name;
    public $description;
    public $price;
    public $img;
    public $category_id;

    public function getTableName() {
        return "goods";
    }
}