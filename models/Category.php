<?php
namespace app\models;

class Category extends Model
{
    public $id;
    public $name;

    public static function getTableName() : string
    {
        return "category";
    }
}