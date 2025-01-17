<?php

require_once __DIR__ . '/../../config/config.php';



class HomePage {
    private $db;
    
    public function __construct() {
        $database = new Database;
        $this->db = $database->connect();
    }
    
    public function getStatistics() {
        $stats = [];
        
        // Total courses
        $stmt = $this->db->query("SELECT COUNT(*) FROM course");
        $stats['total_courses'] = $stmt->fetchColumn();
        
        // Total students
        $stmt = $this->db->query("SELECT COUNT(*) FROM users WHERE role = 'student'");
        $stats['total_students'] = $stmt->fetchColumn();
        
        // Total teachers
        $stmt = $this->db->query("SELECT COUNT(*) FROM users WHERE role = 'teacher'");
        $stats['total_teachers'] = $stmt->fetchColumn();
        
        // Total hours of content
        $stmt = $this->db->query("SELECT SUM(video_hours) FROM course");
        $stats['total_hours'] = round($stmt->fetchColumn());
        
        return $stats;
    }
    
    public function getFeaturedCourses() {
        $stmt = $this->db->query("
            SELECT c.*, u.name as teacher_name, u.profil as teacher_profile, 
                   cat.name as category_name,
                   (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as enrollment_count
            FROM course c
            LEFT JOIN users u ON c.teacher_id = u.id
            LEFT JOIN categories cat ON c.category_id = cat.id
            ORDER BY c.created_at DESC
            LIMIT 6
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTopCategories() {
        $stmt = $this->db->query("
            SELECT c.name, COUNT(co.id) as course_count
            FROM categories c
            LEFT JOIN course co ON c.id = co.category_id
            GROUP BY c.id
            ORDER BY course_count DESC
            LIMIT 4
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBestTeachers() {
        $stmt = $this->db->query("
            SELECT u.*, COUNT(c.id) as course_count
            FROM users u
            LEFT JOIN course c ON u.id = c.teacher_id
            WHERE u.role = 'teacher' AND u.status = 'active'
            GROUP BY u.id
            ORDER BY course_count DESC
            LIMIT 4
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPopularTags() {
        $stmt = $this->db->query("
            SELECT t.*, COUNT(ct.course_id) as usage_count
            FROM tags t
            LEFT JOIN course_tags ct ON t.id = ct.tag_id
            GROUP BY t.id
            ORDER BY usage_count DESC
            LIMIT 8
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}