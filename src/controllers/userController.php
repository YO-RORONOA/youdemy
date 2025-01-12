<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/User.php';

class Usercontroller
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new database;
        $this->db = $database->connect();

        $this->user = new Users($this->db);
    }


    public function getAllusers()
    {
        return $this->user->getAllusers();
    }


}

