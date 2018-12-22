<?php
namespace app\models\repositories;

use app\models\Cart;

class CartRepository extends Repository
{
    public function getTableName() : string {
        return "cart";
    }

    public function getEntityClass(): string {
        return Cart::class;
    }

    public function getCart() {
        $tableName = static::getTableName();
        $sql = "SELECT c.*, g.name as good_name, g.price as good_price
                FROM {$tableName} c
                LEFT JOIN goods g ON g.id = c.good_id
                WHERE session_id = :id";

        return $this->db->queryAllRows($sql, $this->getEntityClass(), [':id' => session_id()]);
    }

    public function getAmount() {
        $tableName = static::getTableName();
        $sql = "SELECT sum(g.price) as amount
                FROM {$tableName} c
                LEFT JOIN goods g ON g.id = c.good_id
                WHERE session_id = :id";

        $result = $this->db->queryArray($sql, [':id' => session_id()]);

        return $result['amount'];
    }

    public function getGoodInCart($good_id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE good_id = :good_id and session_id = :id";

        return $this->db->queryObject($sql, $this->getEntityClass(), [':good_id' => $good_id, ':id' => session_id()]);
    }

    public function addGood($good_id, $quantity) {
        $good = $this->getGoodInCart($good_id);

        if(empty($good)) {
            $good = new Cart(null, $good_id, session_id(), $quantity);
        }
        else {
            $good->quantity += $quantity;
        }

        return $this->save($good);
    }
}