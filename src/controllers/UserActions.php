<?php


class UserActions
{
    private $db;
    private $user;

    public function __construct($db)
    {
        $database = new Database;
        $this->db = $database->connect();
    }


    


}