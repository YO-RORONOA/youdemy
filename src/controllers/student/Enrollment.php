<?php

session_start();
require_once __DIR__ . '/../../config/config.php';



class EnrollmentController {


    private $db;
    
    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
    }

    
    public function isEnrolled($userId, $courseId) {
        $stmt = $this->db->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
        $stmt->execute([$userId, $courseId]);
        return $stmt->rowCount() > 0;
    }
    
    public function enroll($userId, $courseId) {
        try {
            $stmt = $this->db->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
            return $stmt->execute([$userId, $courseId]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function unenroll($userId, $courseId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM enrollments WHERE user_id = ? AND course_id = ?");
            return $stmt->execute([$userId, $courseId]);
        } catch (PDOException $e) {
            return false;
        }
    }


}





if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$enrollmentController = new EnrollmentController();
$userId = $_SESSION['user_id'];
$courseId = $_POST['course_id'] ?? null;
$action = $_POST['action'] ?? null;

// if (!$courseId || !$action) {
//     http_response_code(400);
//     echo json_encode(['error' => 'Missing parameters']);
//     exit;
// }

$result = false;
if ($action === 'enroll') {
    $result = $enrollmentController->enroll($userId, $courseId);
} elseif ($action === 'unenroll') {
    $result = $enrollmentController->unenroll($userId, $courseId);
}

echo json_encode(['success' => $result]);
