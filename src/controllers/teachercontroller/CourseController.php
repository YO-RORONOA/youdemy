<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/Course.php';
require_once __DIR__ . '/../../classes/Course_Tags.php';

session_start();

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['user_role'];

}



class CourseController
{

    private $db;
    private $course;
    private $course_tags;
    private $error_message = [];

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
        $this->course = new Course($this->db);
        $this->course_tags = new CourseTag($this->db);

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


    public function createCoursTags($courseid, $tagid)
    {
     $this->course_tags->setAttributes($courseid, $tagid);
     return $this->course_tags->addTagToCourse();
     
    }

    public function lastInsertedID()
    {
        $lastid = $this->db->lastInsertId();
        return $lastid;
    }









}





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new CourseController();

    $title = $_POST['title'];
    $description = $_POST['description'];
    $tagsId = $_POST['tags']; 
    $content = $_POST['contentUrl'];
    $teacherId = $user_id;
    $categoryId = $_POST['category'];
    $wallpaper = $_POST['wallpaperUrl'];
    $content_type = $_POST['contentType'];
    $video_hours = $_POST['videoHours'];
    $nb_articles = $_POST['articles'];
    $nb_resources = $_POST['resources'];



    $controller->createCourse($title, $description, $content, $teacherId, $categoryId, $wallpaper,  $content_type,
     $video_hours, $nb_articles, $nb_resources);


     $courseId = $controller->lastInsertedID();
     echo `last insert id ${courseId}`;
     var_dump ($tagsId);



     $controller->createCoursTags($courseId, $tagsId);
     

}

