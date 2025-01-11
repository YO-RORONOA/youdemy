<?php


class Database
{
    private $host = "localhost";
    private $user_name = "root";
    private $password = "";
    private $db_name = "youdemy";
    private $conn;


    public function connect()
    {

        try{
            $this->conn = null;
            $this->conn = new pdo("mysql:host=". $this->host. ";dbname=".  $this->db_name, $this->user_name, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}