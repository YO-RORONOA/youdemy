<?php


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


    public function getallusers()
    {
        $this->user->getallusers();
    }


}

$dashUser = new Usercontroller;
$allusers = $dashUser->getallusers();