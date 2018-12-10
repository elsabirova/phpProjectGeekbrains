<?php
namespace app\interfaces;
use app\models\Model;

interface IModel {
    public function getTableName() : string;

    public function getOneRow($id) : Model;

    public function getAllRows();
}