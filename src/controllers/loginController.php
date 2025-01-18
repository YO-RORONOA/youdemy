<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/User.php';

session_start();

class LoginController
{
    protected $db;
    protected $user;
    protected $email;
    protected $password;
    protected $text_error = [];

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->connect();
        $this->user = new Users($this->db);
    }

    public function loginvalidation($data)
    {
        if (isset($data["submit"])) {
            $this->email = $data["email"];
            $this->password = $data["password"];

            if (empty($this->email) || empty($this->password)) {
                $this->text_error['email'] = "Please fill all fields.";
            } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->text_error['email2'] = "Please enter a valid email address.";
            }

            if (!empty($this->text_error)) {
                $_SESSION['text_error'] = $this->text_error;
                header('Location: ../views/auth/login.php');
                exit();
            }

            $userdata = $this->user->getUserbyemail($this->email);


            if (!$userdata) {
                $this->text_error['!user'] = "User not found.";
                $_SESSION['text_error'] = $this->text_error;
                $this->redirectlogin();
            }
            if (!password_verify($this->password, $userdata['password'])) {
                $this->text_error['!password'] = "Password is incorrect.";
                $_SESSION['text_error'] = $this->text_error;
                $this->redirectlogin();
            }

            // Success - Store session data
            $_SESSION['user_id'] = $userdata['id'];
            $_SESSION['user_role'] = $userdata['role'];
            $_SESSION['user_name'] = $userdata['name'];
            $_SESSION['user_status'] = $userdata['name'];
            if($userdata['role'] == 'teacher')
            {
            header('Location: ../views/teacher/subscriptionManagment.php');

            }
            else
            header('Location: ../views/user/allcourses.php');
            exit();
        }
    }

    public function redirectlogin()
    {
        header('Location: ../views/auth/login.php');
        exit();
    }
}

$login = new LoginController;
$login->loginvalidation($_POST);
