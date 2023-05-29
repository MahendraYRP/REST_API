<?php

header("Access-Control-Allow-Origin: *");
//2.method type is json header=> Content-type and body=> application/json
header("Content-type: application/json; charset: UTF-8");
//3.header -> POST method
header("Access-Control-Allow-Methods: POST");



include_once("../config/database.php");
include_once("../classes/student.php");


$db = new Database();
$connect =   $db->connect();


$student = new Student($connect);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    

    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->name) && !empty($data->email) && !empty($data->phone)) {
       
        $student->name = $data->name;
        $student->email = $data->email;
        $student->phone = $data->phone;

        if ($student->create_data()) {

            http_response_code(200); 
            echo json_encode(array(
                "status" => 1,
                "message" => "Student data inserted"
            ));
        } else {
            http_response_code(500); 
            echo json_encode(array(
                "status" => 0,
                "message" => " Failed To insert the data"
            ));
        }
    } else {
        http_response_code(404); 
        echo json_encode(array(
            "status" => 0,
            "message" => "Not Be Empty"
        ));
    }
} else {
    http_response_code(503); 
    echo json_encode(array(
        "status" => 0,
        "message" => "Access denied"
    ));
}
?>