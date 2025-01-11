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