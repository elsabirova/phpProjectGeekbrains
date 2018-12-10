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
    public static function getOneRow($id) : Model
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return Db::getInstance()->queryObject($sql, get_called_class(), [':id' => $id]);
    }


    /**
     * @return Model[]
     */
    public static function getAllRows() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return Db::getInstance()->queryAllRows($sql, get_called_class());
    }

    public function save() {
        // TODO: Implement save() method.
    }


    /**
     * @return int
     */
    public function insert()
    {
        $tableName = static::getTableName();
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
    public function update() {
        $tableName = static::getTableName();

        $placeholder = [];
        /*foreach ($data as $key => $value) {
            $placeholder[] = $key . ' = ?';
        }
        $placeholder = implode(', ', $placeholder);

        $sql = "UPDATE {$tableName} SET $placeholder WHERE id = ?";

        $params = array_values($data);
        $params[] = $this->id;

        return $this->db->execute($sql, $params);*/
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