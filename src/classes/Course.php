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
    abstract public function fetchCourse();

    public function getAllcourses()
    {
        $query = "SELECT * from course";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateCourse($id)
{
    $query = "UPDATE course 
              SET title = :title, description = :description, content = :content, 
                  categoryid = :categoryId, wallpaper_url = :wallpaper
              WHERE id = :id";
    
    $stmt = $this->db->prepare($query);

    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':content', $this->content);
    $stmt->bindParam(':categoryId', $this->categoryId);
    $stmt->bindParam(':wallpaper_url', $this->wallpaper);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();  
}

public function deleteCourse($id) {
    $query = "DELETE FROM course WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
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