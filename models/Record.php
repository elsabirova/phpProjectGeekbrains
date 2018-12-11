<?php
namespace app\models;

use app\interfaces\IRecord;
use app\services\Db;

abstract class Record implements IRecord
{
    protected $db;

    /**
     * Record constructor.
     */
    public function __construct() {
        $this->db = Db::getInstance();
    }

    /**
     * @param $id
     * @return Record
     */
    public static function getOneRow($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return Db::getInstance()->queryObject($sql, get_called_class(), [':id' => $id]);
    }


    /**
     * @return Record[]
     */
    public static function getAllRows() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return Db::getInstance()->queryAllRows($sql, get_called_class());
    }

    public function save()
    {
        $id = $this->id;
        if($id) {
            if(static::getOneRow($id)) {
                $this->update();
            }
            else {
                $this->insert();
            }
        }
        else {
            $this->insert();
        }
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
            if(is_scalar($value)) {
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
     * @return int
     */
    public function update()
    {
        $tableName = static::getTableName();
        $placeholders = [];
        $params = [];

        foreach ($this as $key => $value) {
            if(is_scalar($value) && $key != 'id') {
                $placeholders[] = $key . ' = ?';
                $params[] = $value;
            }
        }
        $params[] = $this->id;

        $placeholders = implode(', ', $placeholders);
        $sql = "UPDATE {$tableName} SET $placeholders WHERE id = ?";

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