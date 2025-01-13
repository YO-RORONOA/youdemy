<?php



class Categorie
{

    private $id;
    private $name;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;       
    }

    public function setattributes($name)
    {
        $this->name= $name;
    }

    public function createCategory() {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editCategory($id, $newname) {
            $query = "UPDATE categories SET name = :newname WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':newname', $newname);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
    }

    public function deleteCategory($id) {
            $query = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
    }
}