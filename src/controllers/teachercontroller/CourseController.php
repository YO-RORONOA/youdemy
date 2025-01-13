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


    public function createCourse($title, $description, $content, $teacherId, $categoryId, $wallpaper,  $content_type, $video_hours, $nb_articles, $nb_resources)
    {
        $this->course->setAttributes($title, $description, $content, $teacherId, $categoryId, $wallpaper,  $content_type, $video_hours, $nb_articles, $nb_resources);
        return $this->course->createCourse();
    }


    public function getAllCourses()
    {
        return $this->course->getAllcourses();
    }














}