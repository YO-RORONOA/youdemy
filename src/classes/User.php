<?php



class Users
{
    private $db;
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    private $profil;
    private $status;
    private $isApproved;
    private $createdAt;


    public function __construct($db)
    {
        $this->db = $db;
    }

    public function setAttributes($name, $email, $password, $role ='student', $profil, $status='inactive')
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->isApproved = ($role === 'teacher') ? false : true;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->profil = $profil;
        $this->status= $status;
    }


    public function createUser()
    {
        $query = "INSERT into users(name, email, password, role, profil, status)
        values(:name, :email, :password, :role, :profil, :status)";
        $stmt = $this->db->prepare($query);
        $stmt->bindparam(':name', $this->name);
        $stmt->bindparam(':email', $this->email);
        $stmt->bindparam(':password', $this->password);
        $stmt->bindparam(':role', $this->role);
        $stmt->bindparam(':profil', $this->profil);
        $stmt->bindparam(':status', $this->status);
        return $stmt->execute();
    }

    public function getUserbyemail($email)
    {
        $query = "SELECT * from users
        where email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindparam('email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function approveTeacher() {
        if ($this->role === 'teacher') {
            $this->isApproved = true;
        }
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam('id', $id);
        return $stmt->execute;
    }

    public function getAllusers()
    {
        $sql = "SELECT * from users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function updateUserstatus($id, $newstatus)
    {
        $sql = "UPDATE users
        set status = :newstatus where id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(':newstatus', $newstatus);
        $stmt->bindparam(':id', $id);
        return $stmt->execute();
        
    }

}