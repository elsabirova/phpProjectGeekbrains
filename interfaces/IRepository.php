<?php
namespace app\interfaces;
use app\models\Record;

interface IRepository
{
    public function getTableName() : string;

    public function getEntityClass() : string;

    public function getOneRow($id);

    public function getAllRows();

    public function save(Record $record);

    public function insert(Record $record);

    public function update(Record $record);

    public function delete($id);
}