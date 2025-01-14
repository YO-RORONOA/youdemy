<?php

require_once __DIR__ . '../../config/config.php';

require_once 'Course.php';


class VideoCourse extends Course

{
    
    public function __construct(
        $db,
        $title,
        $description,
        $content,
        $teacherId,
        $categoryId,
        $wallpaper,
        $content_type,
        $video_hours,
        $nb_articles,
        $nb_resources
    ) {
        parent::__construct($db);
        $this->setAttributes(
            $title,
            $description,
            $content,
            $teacherId,
            $categoryId,
            $wallpaper,
            $content_type,
            $video_hours,
            $nb_articles,
            $nb_resources
        );
    }

    public function createCourse()
    {
        //bindvalue instead of param to avoid error because param expects reference
        $query = "INSERT into course(title, description, content, teacher_id, category_id, wallpaper_url, content_type, video_hours, nb_articles, nb_resources)
        values(:title, :description, :content, :teacher_id, :categorie_id, :wallpaper_url, :content_type, :video_hours, :nb_articles, :nb_resources)";
        $stmt= $this->getdb()->prepare($query);
        $stmt->bindvalue(':title', $this->getTitle());
        $stmt->bindvalue(':description', $this->getDescription());
        $stmt->bindvalue(':content', $this->getContent());
        $stmt->bindvalue(':teacher_id', $this->getTeacherId());
        $stmt->bindvalue(':categorie_id', $this->getCategoryId());
        $stmt->bindvalue(':wallpaper_url', $this->getWallpaper());
        $stmt->bindvalue(':content_type', $this->getContentType());
        $stmt->bindvalue(':video_hours', $this->getVideoHours());
        $stmt->bindvalue(':nb_articles', $this->getNbArticles());
        $stmt->bindvalue(':nb_resources', $this->getNbResources());

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

        $stmt = $this->getdb()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

       
}

?>
