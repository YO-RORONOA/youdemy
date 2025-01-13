<?php


class CourseTag {
    private $courseId;
    private $tagId;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function setAttributes($courseid, $tagid)
    {
        $this->courseId = $courseid;
        $this->tagId = $tagid;
    }

    public function addTagToCourse() {
        $query = "INSERT INTO course_tags (course_id, tag_id) VALUES (:courseId, :tagId)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':courseId', $this->courseId);
        $stmt->bindParam(':tagId', $this->tagId);
        return $stmt->execute();
    }

    public function getTagsByCourse($db, $courseId) {
        $query = "SELECT tags.* FROM tags
                  JOIN course_tags ON tags.id = course_tags.tag_id
                  WHERE course_tags.course_id = :courseId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':courseId', $courseId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
