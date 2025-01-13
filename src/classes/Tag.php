<?php


class Tag {
    private $id;
    private $name;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function setTag($name)
    {
        $this->name = $name;
    }

    public function createTag() {
        $query = "INSERT INTO tags (name) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    public function getAllTags() {
        $query = "SELECT * FROM tags";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function edittag($id, $newtag)
    {
        $query = "UPDATE tags set name_tag = :newtag where id= :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':newtag', $newtag);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deletetag($id)
    {
        $query = "DELETE from tags where id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    
    }
}
?>
