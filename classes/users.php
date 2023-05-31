<?php

class Users
{

    public $name;
    public $email;
    public $password;
    public $user_id;
    public $project_name;
    public $description;
    public $status;


    private $conn;
    private $users;
    private $project;


    public function __construct($db)
    {
        $this->conn = $db;
        $this->users = "users";
        $this->project = "project";
    }

    // public function create_user()
    // {
    //     $user_query = "INSERT INTO " . $this->users . " SET name = ? , email = ?, password = ?,";

    //     $user_obj = $this->conn->prepare($user_query);

    //     $user_obj->bind_param("sss", $this->name, $this->email, $this->password);

    //     if ($user_obj->execute()) {
    //         return true;
    //     }
    //     return false;

    // }


    public function create_user()
    {
        $user_query = "INSERT INTO " . $this->users . " SET name = ?, email = ?, password = ?";

        
        $user_obj = $this->conn->prepare($user_query);
      
        $user_obj->bindParam(1, $this->name);
        $user_obj->bindParam(2, $this->email);
        $user_obj->bindParam(3, $this->password);

        if ($user_obj->execute()) {
            return true;
        }
        return false;
    }


}




?>