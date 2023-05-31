<?php 

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json: charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once("../config/database.php");
include_once("../classes/student.php");

$db = new Database();
$connect =   $db->connect();
$student = new Student($connect);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $data = json_decode(file_get_contents("php://input"));


   
    if (!empty($data->name) && !empty($data->email) && !empty($data->phone) && !empty($data->id)) {
    
          
        $student->name = $data->name;
        $student->email = $data->email;
        $student->phone = $data->phone;
        $student->id   = $data->id;
       
        if ($student->update_data()) {
            http_response_code(200);
            echo json_encode(array(
                "status"=>0,
                "message"=>"Student Data successfully updated",
            ));
          
        }else{
            http_response_code(500);
            echo json_encode(array(
                "status"=>0,
                "message"=>"Faild to update data 1",
            ));
        }

    }else{
        http_response_code(500);
        echo json_encode(array(
            "status"=>0,
            "message"=>"Faield to update data 2",
        ));
    }


}else{
    http_response_code(503);
    echo json_encode(array(
        "status"=>0,
        "message"=>"Access denied",
    ));
}

?>