<?php
namespace app\models;

class User extends Record
{
    public $id;
    public $first_name;
    public $last_name;
    public $login;
    public $password;

    public static function getTableName() : string
    {
        return 'users';
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}