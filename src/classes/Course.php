<?php



class Course
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

    public function createCourse()
    {
        $query = "INSERT into course(title, description, content, teacher_id, category_id, wallpaper_url, content_type, video_hours, nb_articles, nb_resources)
        values(:title, :description, :content, :teacher_id, :categorie_id, :wallpaper_url, :content_type, :video_hours, :nb_articles, :nb_resources)";
        $stmt= $this->db->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':teacher_id', $this->teacherId);
        $stmt->bindParam(':categorie_id', $this->categoryId);
        $stmt->bindParam(':wallpaper_url', $this->wallpaper);
        $stmt->bindParam(':content_type', $this->content_type);
        $stmt->bindParam(':video_hours', $this->video_hours);
        $stmt->bindParam(':nb_articles', $this->nb_articles);
        $stmt->bindParam(':nb_resources', $this->nb_resources);

        return $stmt->execute();
    }

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



}