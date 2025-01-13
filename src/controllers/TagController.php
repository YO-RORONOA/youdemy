<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/Tag.php';



class TagController
{

    protected $db;
    protected $tag;
    protected $error_message = [];

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
        $this->tag = new Tag($this->db);
    }

    public function createTag($data)
    {
        echo'error';
        $name_tag = trim($data['namecategorie']);

        if (empty($name_categorie)) {
            $this->error_message['error_message'] = 'Tag name is required.';
        } elseif (strlen($name_categorie) < 3) {
            $this->error_message['error_message'] = "Tag name must be at least 3 characters.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name_categorie)) {
            $this->error_message['error_message'] = "Tag name must only contain letters and spaces.";
        }


        if (!empty($this->error_message)) {
            $_SESSION['error_message'] = $this->error_message;
            header('Location: ../views/admin/tagsControl.php');
            exit();
        }

        $this->tag->setTag($name_tag);

        if ($this->tag->createTag()) {
            $_SESSION['success_message'] = "Category successfully created!";
        } else {
            $_SESSION['error_message'] = ["Failed to create category. Please try again."];
        }
        header('Location: ../views/admin/tagsControl.php');
    }


    public function getAllTags()
    {
        return $this->tag->getAllTags();
    }

    public function editTag($id, $newcategorie)
    {
        return $this->tag->editTag($id, $newcategorie);
    }

    public function deleteTag($id)
    {
        return $this->tag->deletetag($id);
    }

    public function getTagId($id)
    {
        $sql = "SELECT * FROM tags WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}