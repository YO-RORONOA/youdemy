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



    public function addTagsToCourse($courseId, $tagIds)
    {
        foreach ($tagIds as $tagId) {
            $query = "INSERT INTO Course_Tags (course_id, tag_id) VALUES (:courseId, :tagId)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':courseId', $courseId);
            $stmt->bindParam(':tagId', $tagId);
            $stmt->execute();
        }
    }










}





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $tags = $_POST['tags']; 
    $content = $_POST['contentUrl'];
    $teacherId = $_POST['tags'];
    $categoryId = $_POST['category'];
    $wallpaper = $_POST['wallpaperUrl'];
    $content_type = $_POST['contentType'];
    $video_hours = $_POST['videoHours'];
    $nb_articles = $_POST['articles'];
    $nb_resources = $_POST['resources'];





}