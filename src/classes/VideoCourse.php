<?php
require_once 'Course.php';

class VideoCourse extends Course
{
    private $video_hours;

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

    public function fetchCourse()
    {
        $query = "SELECT Course.id, Course.title, Course.description, Course.content, GROUP_CONCAT(Tags.name) AS tag_names
      FROM Course
      LEFT JOIN Course_Tags ON Course.id = Course_Tags.course_id
      LEFT JOIN Tags ON Course_Tags.tag_id = Tags.id
      WHERE Course.content_type = 'video'
      GROUP BY Course.id";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>
