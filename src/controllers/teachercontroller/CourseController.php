<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/Course.php';



class CategorieController
{

    protected $db;
    protected $course;
    protected $error_message = [];

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
        $this->course = new Course($this->db);
    }








    
}