<?php
namespace app\models\repositories;

use app\models\Good;

class GoodRepository extends Repository
{
    public function getTableName() : string {
        return "goods";
    }

    public function getEntityClass(): string {
        return Good::class;
    }
}