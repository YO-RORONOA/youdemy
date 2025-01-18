<?php

require_once __DIR__ . '/../../config/config.php';

class DashboardController {
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
    }
    public function getTotalCourses() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM course");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getCoursesByCategory() {
        $query = "SELECT c.name as category_name, COUNT(co.id) as course_count 
                 FROM categories c 
                 LEFT JOIN course co ON c.id = co.category_id 
                 GROUP BY c.id, c.name
                 ORDER BY course_count DESC";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMostPopularCourse() {
        $query = "SELECT c.title, COUNT(e.user_id) as student_count, 
                        u.name as teacher_name, cat.name as category_name
                 FROM course c
                 LEFT JOIN enrollments e ON c.id = e.course_id
                 LEFT JOIN users u ON c.teacher_id = u.id
                 LEFT JOIN categories cat ON c.category_id = cat.id
                 GROUP BY c.id, c.title, u.name, cat.name
                 ORDER BY student_count DESC
                 LIMIT 1";
        return $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
    }

    public function getTopTeachers() {
        $query = "SELECT u.name as teacher_name,
                        COUNT(DISTINCT c.id) as course_count,
                        COUNT(DISTINCT e.user_id) as total_students
                 FROM users u
                 LEFT JOIN course c ON u.id = c.teacher_id
                 LEFT JOIN enrollments e ON c.id = e.course_id
                 WHERE u.role = 'teacher'
                 GROUP BY u.id, u.name
                 ORDER BY total_students DESC, course_count DESC
                 LIMIT 3";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}