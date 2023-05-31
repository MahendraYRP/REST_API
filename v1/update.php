<?php 

// header("Access-Control-Allow-Origin: *");
// header("Content-type:application/json: charset=UTF-8");
// header("Access-Control-Allow-Methods: UPDATE");

// include_once("../config/database.php");
// include_once("../classes/student.php");

// $db = new Database();
// $connect =   $db->connect();
// $student = new Student($connect);


// if ($_SERVER["REQUEST_METHOD"] === "UPDATE") {
    
//     $updateData = json_decode(file_get_contents("php://input"));

//     if (!empty($updateData->name) && !empty($updateData->email) && !empty($updateData->phone) && !empty($updateData->id)) {
          
//         $student->name = $updateData->name;
//         $student->email = $updateData->email;
//         $student->phone = $updateData->phone;
//         $student->id   = $updateData->id;

//     }

// }else{
//     http_response_code(503);
//     echo json_encode(array(
//         "status"=>0,
//         "message"=>"Access denied",
//     ));
// }

?>