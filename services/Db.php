<?php

namespace app\services;

use app\traits\TSingleton;

class Db {
    use TSingleton;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'dbtest',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ];

    private $conn = null;

    /**
     * @return \PDO|null
     */
    private function getConnection() {
        if (is_null($this->conn)) {
            try {
                $this->conn = new \PDO(
                    $this->prepareDsnString(),
                    $this->config['user'],
                    $this->config['password']);

                $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
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
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
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
     * @param array $params
     * @return array
     */
    public function queryAllRows($sql, $params = []) {
        $pdoStatement = $this->query($sql, $params);
        return $pdoStatement->fetchAll();
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    public function queryOneRow($sql, $params = []) {
        return $this->queryAllRows($sql, $params);
    }
}