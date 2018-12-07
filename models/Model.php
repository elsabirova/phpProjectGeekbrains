<?php
namespace app\models;

use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel {
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct() {
        $this->db = new Db();
    }

    public function getOneRow($id) {
        $id = (int)$id;
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id ={$id}";
        return $this->db->queryOneRow($sql);
    }

    public function getAllRows() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAllRows($sql);
    }
}