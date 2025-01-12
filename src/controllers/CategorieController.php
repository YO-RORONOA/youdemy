<?php




class CategorieController
{

    protected $db;
    protected $categorie;
    protected $error_message = [];

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
        $this->categorie = new Categorie($this->db);
    }

    public function createCategorie($data)
    {

        $name_categorie = trim($data['namecategorie']);

        if (empty($name_categorie)) {
            $this->error_message['error_message'] = 'Category name is required.';
        } elseif (strlen($name_categorie) < 3) {
            $this->error_message['error_message'] = "Category name must be at least 3 characters.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name_categorie)) {
            $this->error_message['error_message'] = "Category name must only contain letters and spaces.";
        }


        if (!empty($this->error_message)) {
            $_SESSION['error_message'] = $this->error_message;
            header('Location: ../views/admin/categoriecontrol.php');
            exit();
        }

        $this->categorie->setattributes($name_categorie);

        if ($this->categorie->createCategory()) {
            $_SESSION['success_message'] = "Category successfully created!";
        } else {
            $_SESSION['error_message'] = ["Failed to create category. Please try again."];
        }
        header('Location: ../views/categorieManagement.php');
        exit();
    }


    public function getAllCategories()
    {
        return $this->categorie->getallcategories();
    }

    public function editCategories($id, $newcategorie)
    {
        return $this->categorie->editCategory($id, $newcategorie);
    }

    public function deleteCategory($id)
    {
        return $this->categorie->deleteCategory($id);
    }

    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
