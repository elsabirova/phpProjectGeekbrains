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
        $this->db = Db::getInstance();
    }

    /**
     * @param $id
     * @return array
     */
    public function getOneRow($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return $this->db->queryOneRow($sql, [':id' => $id]);
    }

    /**
     * @return array
     */
    public function getAllRows() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return $this->db->queryAllRows($sql);
    }

    /**
     * @param $data = ['name'=>'Rosa','price'=>'3000','img'=>'1','category_id'=>'2'];
     * @return int
     */
    public function createRow($data) {
        $tableName = $this->getTableName();
        $keys = array_keys($data);
        $fields = '`' . implode('`, `', $keys) . '`';

        $placeholder = substr(str_repeat('?,', count($keys)), 0, -1);

        $sql = "INSERT INTO {$tableName} ($fields) VALUES($placeholder)";

        $params = array_values($data);

        return $this->db->execute($sql, $params);
    }

    /**
     * @param $id
     * @param $data
     * @return int
     */
    public function updateRow($id, $data) {
        $tableName = $this->getTableName();

        $placeholder = [];
        foreach ($data as $key => $value) {
            $placeholder[] = $key . ' = ?';
        }
        $placeholder = implode(', ', $placeholder);

        $sql = "UPDATE {$tableName} SET $placeholder WHERE id = ?";

        $params = array_values($data);
        $params[] = $id;

        return $this->db->execute($sql, $params);
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteRow($id) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id=:id";

        return $this->db->execute($sql, [':id' => $id]);
    }
}