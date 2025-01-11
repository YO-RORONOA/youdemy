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

    public function __construct($db)
    {
        $this->db = $db;       
    }

    public function setAttributes($title, $description, $content, $teacherId, $categoryId, $wallpaper)
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->teacherId = $teacherId;
        $this->categoryId = $categoryId;
        $this->wallpaper = $wallpaper;
    }

    public function createCourse()
    {
        $query = "INSERT into course(title, description, content, teacher_id, categorie_id, wallpaper_url)
        values(:title, :description, :content, :teacher_id, :categorie_id, :wallpaper_url)";
        $stmt= $this->db->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':teacher_id', $this->teacherId);
        $stmt->bindParam(':categorie_id', $this->categoryId);
        $stmt->bindParam(':wallpaper_url', $this->wallpaper);
        return $stmt->execute();
    }

    public function getAllcourses()
    {
        $query = "SELECT * from course";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}