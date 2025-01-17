<?php



abstract class Course
{
    private $db;
    private $id;
    private $title;
    private $description;
    private $content;
    private $wallpaper;
    private $teacherId;
    private $categoryId;
    private $tags = [];
    private $content_type;
    private $video_hours;
    private $nb_articles;
    private $nb_resources;

    public function __construct($db)
    {
        $this->db = $db;       
    }

    public function setAttributes($title, $description, $content, $teacherId, 
    $categoryId, $wallpaper, $content_type, $video_hours, $nb_articles, $nb_resources)
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->teacherId = $teacherId;
        $this->categoryId = $categoryId;
        $this->wallpaper = $wallpaper;
        $this->content_type = $content_type;
        $this->video_hours = $video_hours;
        $this->nb_articles = $nb_articles;
        $this->nb_resources = $nb_resources;
    }

    abstract public function createCourse();
    abstract public static function fetchCourse($db);

    public function getAllcourses()
    {
        $query = "SELECT * from course";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function updateCourse($db, $id, $title, $description, $tagsId, $content, $teacherId, $categoryId, $wallpaper, $content_type, $video_hours, $nb_articles, $nb_resources)
    {
        $query = "UPDATE course 
              SET title = :title, description = :description, content = :content, 
                  teacher_id = :teacher_id, category_id = :categoryId, wallpaper_url = :wallpaper,
                  content_type = :content_type, video_hours = :video_hours,
                  nb_articles = :nb_articles, nb_resources = :nb_resources
              WHERE id = :id";

        $stmt = $db->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->bindParam(':wallpaper', $wallpaper);
        $stmt->bindParam(':content_type', $content_type);
        $stmt->bindParam(':video_hours', $video_hours);
        $stmt->bindParam(':nb_articles', $nb_articles);
        $stmt->bindParam(':nb_resources', $nb_resources);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function deleteCourse($db, $id)
    {
        $query = "DELETE FROM course WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }


public static function fetchCoursebyId($db, $id)
    {
        $query = "SELECT Course.id, Course.title, Course.description, Course.content_type, 
        Course.content, Course.wallpaper_url,
        Course.video_hours, Course.nb_articles, categories.name,
        Course.nb_resources, GROUP_CONCAT(Tags.name) AS tag_names,
        GROUP_CONCAT(Tags.id) AS tag_ids
      FROM Course
      LEFT JOIN Course_Tags ON Course.id = Course_Tags.course_id
      LEFT JOIN Tags ON Course_Tags.tag_id = Tags.id
      LEFT JOIN categories ON categories.id = Course.category_id
      WHERE Course.id = :id
      GROUP BY Course.id";

        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCoursesByTeacher($teacher_id, $db) {
        $query = "SELECT * FROM course WHERE teacher_id = :teacher_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



public function getdb()
    {
        return $this->db;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getWallpaper()
    {
        return $this->wallpaper;
    }
    public function getTeacherId()
    {
        return $this->teacherId;
    }
    public function getCategoryId()
    {
        return $this->categoryId;
    }
    public function getTags()
    {
        return $this->tags;
    }
    public function getContentType()
    {
        return $this->content_type;
    }
    public function getVideoHours()
    {
        return $this->video_hours;
    }
    public function getNbArticles()
    {
        return $this->nb_articles;
    }
    public function getNbResources()
    {
        return $this->nb_resources;
    }



}