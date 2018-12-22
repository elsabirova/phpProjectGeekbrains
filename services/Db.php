<?php
namespace app\services;

use app\models\Record;

class Db
{
    private $driver;
    private $host;
    private $database;
    private $user;
    private $password;
    private $charset;

    private $conn = null;

    /**
     * Db constructor.
     * @param $driver
     * @param $host
     * @param $database
     * @param $user
     * @param $password
     * @param $charset
     */
    public function __construct($driver, $host, $database, $user, $password, $charset) {
        $this->driver = $driver;
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
        $this->charset = $charset;
    }

    private function getConnection() {
        if (is_null($this->conn)) {
            try {
                $this->conn = new \PDO(
                    $this->prepareDsnString(),
                    $this->user,
                    $this->password);

                $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
            }
        }

        return $this->conn;
    }

    /**
     * @return string
     */
    private function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->driver,
            $this->host,
            $this->database,
            $this->charset
        );
    }

    /**
     * @param $sql
     * @param array $params
     * @return bool|\PDOStatement
     */
    private function query($sql, $params = []) {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);

        return $pdoStatement;
    }

    /**
     * @param $sql
     * @param array $params
     * @return int
     */
    public function execute($sql, $params = []) {
        $pdoStatement = $this->query($sql, $params);
        return $pdoStatement->rowCount();
    }

    /**
     * @param $sql
     * @param $class
     * @param array $params
     * @return Record
     */
    public function queryObject($sql, $class, $params = []) {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $pdoStatement->fetch();
    }

    /**
     * @param $sql
     * @param $class
     * @param array $params
     * @return Record[]
     */
    public function queryAllRows($sql, $class, $params = []) {
        $pdoStatement = $this->query($sql, $params);
        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
    }

    public function queryArray($sql, $params = []) {
        $pdoStatement = $this->query($sql, $params);

        return $pdoStatement->fetch();
    }
}