<?php
namespace app\interfaces;
use app\models\Model;

interface IModel
{
    public static function getTableName() : string;

    public static function getOneRow($id) : Model;

    public static function getAllRows();

    public function save();

    public function insert();

    public function update();

    public function delete();
}