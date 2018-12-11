<?php
namespace app\interfaces;
use app\models\Record;

interface IRecord
{
    public static function getTableName() : string;

    public static function getOneRow($id);

    public static function getAllRows();

    public function save();

    public function insert();

    public function update();

    public function delete();
}