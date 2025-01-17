
<?php
session_start();
// require_once __DIR__ . '/enrollmentManagment.php';
require_once __DIR__ . '/../../config/config.php';
// controllers/teacher/enrollmentManagment.php


class enrollmentManagment {
    private $db;
    
    public function __construct() {
        $database = new Database;
        $this->db = $database->connect();
    }
    
    public function getTeacherCourses($teacherId) {
        $stmt = $this->db->prepare("
            SELECT id, title, created_at 
            FROM course 
            WHERE teacher_id = ?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEnrolledStudents($courseId, $teacherId) {
        // Verify the course belongs to this teacher
        $stmt = $this->db->prepare("
            SELECT 
                u.id,
                u.name,
                u.email,
                u.profil as profile_pic,
                e.enrollment_date
            FROM users u
            JOIN enrollments e ON u.id = e.user_id
            JOIN course c ON e.course_id = c.id
            WHERE c.id = ? AND c.teacher_id = ?
            ORDER BY e.enrollment_date DESC
        ");
        $stmt->execute([$courseId, $teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function removeStudentFromCourse($studentId, $courseId, $teacherId) {
        // First verify the course belongs to this teacher
        $stmt = $this->db->prepare("SELECT id FROM course WHERE id = ? AND teacher_id = ?");
        $stmt->execute([$courseId, $teacherId]);
        if ($stmt->rowCount() === 0) {
            return false;
        }
        
        // Then remove the enrollment
        $stmt = $this->db->prepare("DELETE FROM enrollments WHERE user_id = ? AND course_id = ?");
        return $stmt->execute([$studentId, $courseId]);
    }
}







if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
// controllers/teacher/remove-student.php


// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'teacher') {
//     http_response_code(403);
//     echo json_encode(['error' => 'Unauthorized']);
//     exit;
// }

$controller = new enrollmentManagment();
$teacherId = $_SESSION['user_id'];
$studentId = $_POST['student_id'] ?? null;
$courseId = $_POST['course_id'] ?? null;

// if (!$studentId || !$courseId) {
//     http_response_code(400);
//     echo json_encode(['error' => 'Missing parameters']);
//     exit;
// }

$result = $controller->removeStudentFromCourse($studentId, $courseId, $teacherId);
echo json_encode(['success' => $result]);
exit;
}