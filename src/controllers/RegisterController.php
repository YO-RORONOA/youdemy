<?php

require '../classes/User.php';
require '../config/config.php';



class Registercontroller
{
    private $db;
    private $user;
    private $name;
    private $email;
    private $password;
    private $role;
    private $profil;
    private $hashedpassword;

    public function __construct()
    {
        $database = new database;
        $this->db = $database->connect();

        $this->user = new Users($this->db);
    }

    public function validateform($data)
    {

        if (isset($data["submit"])) {
            $this->name = $data["name"];
            $this->email = $data["email"];
            $this->password = $data["password"];
            $this->role = $data["role"];
            $this->profil = $data["profil"];

            $formdata = $data;

            if (empty($this->name)) {
                $error_message["name"] = "Name is required.";
            } elseif (!preg_match("/^[a-zA-Z\s]+$/", $this->name)) {
                $error_message['name'] = "Name can only contain letters and spaces.";
            }

            if (empty($this->email)) {
                $error_message['email'] = "Email is required.";
            } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $error_message['email'] = "Please enter a valid email address.";
            }

            if (empty($this->password)) {
                $error_message['password'] = "Password is required.";
            } elseif (strlen($this->password) < 6) {
                $error_message['password'] = "Password must be at least 6 characters.";
            }

            if (empty($this->profil)) {
                $error_message['profile_picture'] = "Profile picture is required.";
            } elseif (!filter_var($this->profil, FILTER_VALIDATE_URL)) {
                $error_message['profile_picture'] = "Please enter a valid URL.";
            } elseif (substr($this->profil, 0, 8) !== "https://") {
                $error_message['profile_picture'] = "Profile picture URL must start with 'https://'.";
            }

            $this->hashedpassword = password_hash($this->password, PASSWORD_DEFAULT);


            if (!empty($error_message)) {
                $_SESSION['error_message'] = $error_message;
                $_SESSION['formdata'] = $formdata;
                header("Location: ../views/register.php");
                exit;
            } else
                $this->createuser();
            header('Location: ../views/login.php');
        }
    }

    public function createuser()
    {
        $this->user->setattributes($this->name, $this->email, $this->hashedpassword, $this->role);
        $this->user->createuser();
    }
}




$validate = new Registercontroller;

$validate->validateform($_POST);