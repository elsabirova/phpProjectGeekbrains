<?php
namespace app\models\repositories;

use app\base\App;
use app\interfaces\IRepository;
use app\models\Record;

abstract class Repository implements IRepository
{
    protected $db;

    /**
     * Repository constructor.
     */
    public function __construct() {
        $this->db = static::getDb();
    }

    public function getDb() {
        return App::call()->db;
    }

    /**
     * @param $id
     * @return Record
     */
    public function getOneRow($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return $this->db->queryObject($sql, $this->getEntityClass(), [':id' => $id]);
    }


    /**
     * @return Record[]
     */
    public function getAllRows() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return $this->db->queryAllRows($sql, $this->getEntityClass());
    }

    /**
     * @param Record $record
     */
    public function save(Record $record) {
        if ($record->id && static::getOneRow($record->id)) {
            $this->update($record);
        } else {
            $this->insert($record);
        }
    }

    /**
     * @param Record $record
     * @return int
     */
    public function insert(Record $record) {
        $tableName = static::getTableName();
        $fields = [];
        $placeholders = [];
        $params = [];

        foreach ($this as $key => $value) {
            if (is_scalar($value)) {
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
     * @param Record $record
     * @return int
     */
    public function update(Record $record) {
        $tableName = static::getTableName();
        $placeholders = [];
        $params = [];

        foreach ($this as $key => $value) {
            if (is_scalar($value) && $key != 'id') {
                $placeholders[] = $key . ' = ?';
                $params[] = $value;
            }
        }
        $params[] = $record->id;

        $placeholders = implode(', ', $placeholders);
        $sql = "UPDATE {$tableName} SET $placeholders WHERE id = ?";

        return $this->db->execute($sql, $params);
    }

    /**
     * @param Record $record
     * @return int
     */
    public function delete(Record $record) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id=:id";

        return $this->db->execute($sql, [':id' => $record->id]);
    }
}