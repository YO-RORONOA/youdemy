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
        $name_tag = trim($data['nametag']);

        if (empty($name_tag)) {
            $this->error_message['error_message'] = 'Tag name is required.';
        } elseif (strlen($name_tag) < 3) {
            $this->error_message['error_message'] = "Tag name must be at least 3 characters.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name_tag)) {
            $this->error_message['error_message'] = "Tag name must only contain letters and spaces.";
        }


        if (!empty($this->error_message)) {
            $_SESSION['error_message'] = $this->error_message;
            header('Location: ../views/admin/tagsControl.php');
            exit();
        }

        $this->tag->setTag($name_tag);

        if ($this->tag->createTag()) {
            $_SESSION['success_message'] = "tag successfully created!";
        } else {
            $_SESSION['error_message'] = ["Failed to create tag. Please try again."];
        }
        header('Location: ../views/admin/tagsControl.php');
    }


    public function getAllTags()
    {
        return $this->tag->getAllTags();
    }

    public function editTag($id, $newtag)
    {
        return $this->tag->editTag($id, $newtag);
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



if(empty($_POST['tag_id']) && isset($_POST['nametag'])) {

    $controller = new TagController;
    $controller->createTag($_POST);
}

elseif (!empty($_POST['tag_id']) && empty($_POST['action']))
{
    $controller = new TagController;
    $controller->editTag($_POST['tag_id'], $_POST['nametag']);
    header('Location: ../views/admin/tagsControl.php');
}

