<?php



class Users
{
    private $db;
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $isApproved;
    private $createdAt;


    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setAttributes($name, $email, $password, $role ='student')
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->isApproved = ($role === 'teacher') ? false : true;
        $this->createdAt = date('Y-m-d H:i:s');
    }


}