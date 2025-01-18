<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../classes/User.php';

session_start();

class AdminLoginController {
    protected $db;
    protected $user;

    public function __construct() {
        $database = new Database;
        $this->db = $database->connect();
        $this->user = new Users($this->db);
        
        // Generate CSRF token if not exists
        if (empty($_SESSION['csrf_token'])) {
            
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    public function validateAdminLogin($data) {
        try {
            // Verify CSRF token
            if (!isset($data['csrf_token']) || $data['csrf_token'] !== $_SESSION['csrf_token']) {
                throw new Exception('Invalid security token');
            }

            // Validate required fields
            if (empty($data['email']) || empty($data['password'])) {
                throw new Exception('Please fill in all fields');
            }

            // Sanitize email
            $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email format');
            }

            // Get user data
            $stmt = $this->db->prepare("SELECT id, email, password, role, status FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user =  $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify user exists and is an admin
            if (!$user || $user['role'] !== 'admin') {
                throw new Exception('Invalid credentials');
            }

            // Check account status
            if ($user['status'] !== 'active') {
                throw new Exception('Account is not active');
            }

            // Verify password
            if (!password_verify($data['password'], $user['password'])) {
                throw new Exception('Invalid credentials');
            }

            // Success - Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['last_activity'] = time();

            // Redirect to admin dashboard
            header('Location: ../../views/admin/admindash.php');
            exit();

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ../../views/auth/adminlogin.php');
            exit();
        }
    }
}

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Reached the controller";

    $controller = new AdminLoginController();
    $controller->validateAdminLogin($_POST);
}