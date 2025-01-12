<?php


class UserActions
{
    private $db;
    private $user;

    public function __construct($db)
    {
        $database = new Database;
        $this->db = $database->connect();
        $this->user = new Users($this->db);
    }

    public function activateUser($id)
    {
        return $this->user->updateUserstatus($id, 'active');
    }

    public function suspendUser($id)
    {
        return $this->user->updateUserstatus($id, 'suspended');
    }

    public function deleteUser($id)
    {
        return $this->user->updateUserstatus($id, 'deleted');
    }



    public function handleRequest($action, $userId)
    {
        $result = false;
        switch ($action) {
            case 'activate':
                $result = $this->activateUser($userId);
                break;
            case 'suspend':
                $result = $this->suspendUser($userId);
                break;
            case 'delete':
                $result = $this->deleteUser($userId);
                break;
        }

        return $result;
    }
}




