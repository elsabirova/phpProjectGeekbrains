<?php

namespace app\models;

use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct() {
        $this->db = Db::getInstance();
    }


    /**
     * @param $id
     * @return Model
     */
    public function getOneRow($id) : Model
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return $this->db->queryObject($sql, get_called_class(), [':id' => $id]);
    }

    /**
     * @return Model[]
     */
    public function getAllRows() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return $this->db->queryAllRows($sql, get_called_class());
    }

    /**
     * @return int
     */
    public function insert()
    {
        $tableName = $this->getTableName();
        $fields = [];
        $placeholders = [];
        $params = [];
        foreach ($this as $key => $value) {
            if($key != 'db') {
                $fields[] = $key;
                $placeholders[] = '?';
                $params[] = $value;
            }
        }

        $fields = implode(', ', $fields);
        $placeholders = implode(', ', $placeholders);

        $sql = "INSERT INTO {$tableName} ($fields) VALUES($placeholders)";

        return $this->db->execute($sql, $params);
    }

    /**
     * @param $data
     * @return int
     */
    public function update($data) {
        $tableName = $this->getTableName();

        $placeholder = [];
        foreach ($data as $key => $value) {
            $placeholder[] = $key . ' = ?';
        }
        $placeholder = implode(', ', $placeholder);

        $sql = "UPDATE {$tableName} SET $placeholder WHERE id = ?";

        $params = array_values($data);
        $params[] = $this->id;

        return $this->db->execute($sql, $params);
    }

    /**
     * @return int
     */
    public function delete() {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id=:id";

        return $this->db->execute($sql, [':id' => $this->id]);
    }
}