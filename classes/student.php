<?php

class Student
{
    //declare variables
    public $name;
    public $email;
    public $phone;
    public $id;
    private $conn;
    private $table_name;
    

    public function __construct($db)
    {
        $this->conn = $db;
        $this->table_name = "student_data";
    }

    public function create_data()
    {
        
        $insert_query = "INSERT INTO  " . $this->table_name . "  SET name = ?,email = ?,phone = ?";

      
        $obj = $this->conn->prepare($insert_query);

       
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

       
        $obj->bind_param("sss", $this->name, $this->email, $this->phone);

        if ($obj->execute()) {
            return true;
        } else {
            return false;
        }
    }

    
    public function get_all_data()
    {
        $select_query = "SELECT * FROM " . $this->table_name . " ";

        $std_obj = $this->conn->prepare($select_query);


        
        if ($std_obj->execute()) {
            return $std_obj->get_result();
        }
    }


   
    public function get_single_data(){

        $query= "SELECT * FROM  ". $this->table_name ."  WHERE id = ? ";

        
        $result  = $this->conn->prepare($query);
 
       
        $result->bind_param("i",$this->id);

        
         $result->execute();

         $data = $result->get_result();

         return $data->fetch_assoc();


    }


    public function delete_data(){

        $delete_query = "DELETE from ".$this->table_name." WHERE id = ?";

        $result = $this->conn->prepare($delete_query);

        $result->bind_param("i",$this->id);

       if ( $result->execute()) {
        return true;
       }else{
        return false;
       }

        

       
    }


    // public function update_data(){
      
    //     $updateStudent = "UPDATE ".$this->table_name." SET name = ?, email = ?, mobile = ? WHERE id = ? ";

    //     $result = $this->conn->prepare($updateStudent);

    //     $this->name = htmlspecialchars(strip_tags($this->name));
    //     $this->email = htmlspecialchars(strip_tags($this->email));
    //     $this->phone = htmlspecialchars(strip_tags($this->phone));
    //     $this->id = htmlspecialchars(strip_tags($this->id));

    //     $result->bind_param("sssi",$this->name, $this->email,$this->phone, $this->id);

    //     if ($result->execute()) {
    //         return true;
    //     }else{
    //         return false;
    //     }

    // }

    public function update_data()
    {
        $updateStudent = "UPDATE " . $this->table_name . " SET name = ?, email = ?, mobile = ? WHERE id = ?";
    
        $result = $this->conn->prepare($updateStudent);
    
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        $result->bind_param("sssi", $this->name, $this->email, $this->phone, $this->id);
    
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
?>