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


    public function createUser()
    {
        $query = "INSERT into users(name, email, password, role)
        values(:name, :email, :password, :role)";
        $stmt = $this->db->prepare($query);
        $stmt->bindparam('name', $this->name);
        $stmt->bindparam('email', $this->email);
        $stmt->bindparam('password', $this->password);
        $stmt->bindparam('role', $this->role);
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

    public function deleteUser($pdo) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id]);
    }


}