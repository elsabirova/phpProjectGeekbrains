<?php
namespace app\interfaces;
interface IModel {
    public function getTableName();

    public function getOneRow($id);

    public function getAllRows();
}