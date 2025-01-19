<?php
session_start();
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


    public function getAllTags()
    {
        return $this->tag->getAllTags();
    }

    public function editTag($id, $newtag)
    {
        $newtag = trim($newtag);
        
        if (empty($newtag)) {
            $_SESSION['error_message'] = ['Tag name is required.'];
            return false;
        } elseif (strlen($newtag) < 3) {
            $_SESSION['error_message'] = ['Tag name must be at least 3 characters.'];
            return false;
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $newtag)) {
            $_SESSION['error_message'] = ['Tag name must only contain letters and spaces.'];
            return false;
        } elseif ($this->tagExists($newtag)) {
            $_SESSION['error_message'] = ['This tag already exists.'];
            return false;
        }

        if($this->tag->editTag($id, $newtag)) {
            $_SESSION['success_message'] = "Tag successfully updated!";
            return true;
        }
        $_SESSION['error_message'] = ['Failed to update tag.'];
        return false;
    }

    public function deleteTag($id)
    {
        if ($this->tagHasCourses($id)) {
            return false;
        }
        return $this->tag->deleteTag($id);
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
        try {
            foreach($tags as $tag) {
                $tag = trim($tag);
                
                // Validation checks
                if (empty($tag)) {
                    $this->error_message['error_message'] = 'Tag name is required.';
                } elseif (strlen($tag) < 3) {
                    $this->error_message['error_message'] = "Tag name must be at least 3 characters.";
                } elseif (!preg_match("/^[a-zA-Z\s]+$/", $tag)) {
                    $this->error_message['error_message'] = "Tag name must only contain letters and spaces.";
                } elseif ($this->tagExists($tag)) {
                    $this->error_message['error_message'] = "Tag '$tag' already exists.";
                }

                if (!empty($this->error_message)) {
                    $_SESSION['error_message'] = $this->error_message;
                    header('Location: ../views/admin/tagsControl.php');
                    exit();
                }
            }

            $this->db->beginTransaction();
            $stmt = $this->db->prepare("INSERT INTO tags(name) VALUES(:tags)");
            
            foreach($tags as $tag) {
                if(!empty($tag)) {
                    $stmt->bindParam(':tags', $tag);
                    $stmt->execute();
                }
            }
            
            $this->db->commit();
            $_SESSION['success_message'] = "Tags successfully created!";
            header('Location: ../views/admin/tagsControl.php');
            
        } catch (PDOException $e) {
            $this->db->rollBack();
            $_SESSION['error_message'] = ["Failed to create tags. Please try again."];
            header('Location: ../views/admin/tagsControl.php');
        }
    }

    public function tagHasCourses($tagId)
    {
        $sql = "SELECT COUNT(*) FROM course_tags WHERE tag_id = :tag_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tag_id', $tagId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }


    public function tagExists($tagName)
    {
        $sql = "SELECT COUNT(*) FROM tags WHERE LOWER(name) = LOWER(:name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $tagName, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
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

        if ($controller->tagHasCourses($Id)) {
            echo json_encode([
                'success' => false, 
                'message' => 'Cannot delete this tag because it has associated courses.'
            ]);
            exit;
        }

        if ($controller->deletetag($Id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete tag.']);
        }
        exit;
    } 
} 

