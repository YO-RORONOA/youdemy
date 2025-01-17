<?php

class Logout
{


    public function logout()
    {
        if (!isset($_SESSION['user_id'])) {

            session_start(); 

            session_unset();
            session_destroy();
        
        header("Location: ../../views/auth/login.php");
        exit();
        }
    }


}

$logout = new Logout;
$logout->logout();