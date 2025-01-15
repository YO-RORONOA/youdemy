<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/Course.php';
require_once __DIR__ . '/../../classes/Course_Tags.php';
require_once __DIR__ . '/../../classes/VideoCourse.php';

session_start();

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['user_role'];

}



class CourseController
{

    private $db;
    private $course_tags;
    private $error_message = [];

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
        $this->course_tags = new CourseTag($this->db);
    }

    public function createCourse($title, $description, $content, $teacherId, $categoryId, $wallpaper,  $content_type, $video_hours, $nb_articles, $nb_resources)
    {
        if ($content_type === 'video') {
            $videocontroller = new VideoCourse($this->db, $title, $description, $content, $teacherId, $categoryId, $wallpaper, $content_type, $video_hours, $nb_articles, $nb_resources);
            return $videocontroller->createCourse();
        } elseif ($content_type === 'document') {
            $documentcontroller = new DocumentCourse($this->db, $title, $description, $content, $teacherId, $categoryId, $wallpaper, $content_type, $video_hours, $nb_articles, $nb_resources);
            return $documentcontroller->createCourse();
        } else {
            throw new Exception("Invalid content type");
        }
    }



    public function fetchAllCourse($content_type)
    {
        if ($content_type === 'video') {
            return  VideoCourse::fetchCourse($this->db);
        } elseif ($content_type === 'document') {
            return DocumentCourse::fetchCourse($this->db);
        } else {
            throw new Exception("Invalid content type");
        }
    }


    // public function getAllCourses()
    // {
    //     return $this->course->getAllcourses();
    // }



    // public function bindTagsToCourse($courseId, $tagIds)
    // {
    //     foreach ($tagIds as $tagId) {
    //         $query = "INSERT INTO Course_Tags (course_id, tag_id) VALUES (:courseId, :tagId)";
    //         $stmt = $this->db->prepare($query);
    //         $stmt->bindParam(':courseId', $courseId);
    //         $stmt->bindParam(':tagId', $tagId);
    //         $stmt->execute();
    //     }
    // }


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





    public function fetchCourseById($id)
    {
        return  Course::fetchCoursebyId($this->db, $id);

    }

    public function updateCourse($id, $title, $description, $tagsId, $content, $teacherId, $categoryId, $wallpaper, $content_type, $video_hours, $nb_articles, $nb_resources)
    {
        return Course::updateCourse($this->db, $id, $title, $description, $tagsId, $content, $teacherId, $categoryId, $wallpaper, $content_type, $video_hours, $nb_articles, $nb_resources);
    }


    public function deleteTagsFromAssTable($courseId)
    {
        $this->db->prepare("DELETE FROM Course_Tags WHERE course_id = ?")->execute([$courseId]);

    }

    public function insertTagsFromAssTable($tags, $courseId)
    {
        $stmt = $this->db->prepare("INSERT INTO Course_Tags (course_id, tag_id) VALUES (?, ?)");
        foreach ($tags as $tagId) {
            $stmt->execute([$courseId, $tagId]);
        }
    }

}





if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['courseId']) ) {
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

     $controller->createCoursTags($courseId, $tagsId);


}


elseif (!empty($_POST['courseId']) && $_SERVER['REQUEST_METHOD'] === 'POST')
{
    $controller = new CourseController();

    $courseId = $_POST['courseId'];
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
    

    $controller->updateCourse($courseId, $title, $description, $tagsId, $content, $teacherId, $categoryId, $wallpaper, $content_type, $video_hours, $nb_articles, $nb_resources);
    $controller->deleteTagsFromAssTable($courseId);
    $controller->insertTagsFromAssTable($tagsId, $courseId);
}











if (isset($_GET['action']) == 'edit' && isset($_GET['id'])) {
    $controller = new CourseController();

    $id= $_GET['id'];

    $course = $controller->fetchCourseById($id);
    echo json_encode($course); 
}