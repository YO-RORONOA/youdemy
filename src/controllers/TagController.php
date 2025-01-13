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

    public function bulkInsertTags($tags)
    {
        try
        {
            $this->db->beginTransaction();
            
            $stmt = $this->db->prepare("INSERT into tags(name) values(:tags)");
            foreach($tags as $tag)
            {
                if(!empty($tag))
                {
                    $stmt->bindparam(':tags', $tag);
                    $stmt->execute();
                }
            }
            $this->db->commit();
            $error_message['tag-sucesseful'] = "tags added successfully";
        }
 catch (PDOException $e) {
        $this->db->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

}


if(empty($_POST['tag_id']) && isset($_POST['nametag'])) {

    $tagsInput = $_POST['nametag'];
    $tagArray = array_map('trim', explode(',', $tagsInput));

    $controller = new TagController;
    $controller->bulkInsertTags($tagArray);
    header('Location: ../views/admin/tagsControl.php');

}

elseif (!empty($_POST['tag_id']) && empty($_POST['action']))
{
    $controller = new TagController;
    $controller->editTag($_POST['tag_id'], $_POST['nametag']);
    header('Location: ../views/admin/tagsControl.php');
}





if (isset($_GET['id'])) {
    $controller = new TagController();
    $tag = $controller->getTagId($_GET['id']); 

    // Return category data as JSON for the JavaScript AJAX call
    echo json_encode($tag);
    exit;
}














if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'delete') {
        $controller = new TagController();
        $Id = intval($_POST['id']);

        if ($controller->deletetag($Id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete tag.']);
        }
        exit;
    } 
} 

