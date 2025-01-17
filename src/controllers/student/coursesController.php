<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/course.php';





class CoursesController
{
    private $db;

    
    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
    }



    public function fetchAllCourses()
    {
        return Course::getAllcourses($this->db);
    }
}