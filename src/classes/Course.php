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

    




}