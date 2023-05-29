<?php
ini_set("display_errors",1);
//headers
//1.header -> access to every site
header("Access-Control-Allow-Origin: *");
//2.method type is json header=> Content-type and body=> application/json
header("Content-type: application/json; charset=UTF-8");
//3.header -> POST method
header("Access-Control-Allow-Methods: POST");


//include database and student
include_once("../config/database.php");
include_once("../classes/student.php");

//create object for database
$db = new Database();
$connect =   $db->connect();

//Student
$student = new Student($connect);

if($_SERVER['REQUEST_METHOD'] === 'POST'){

$params = json_decode(file_get_contents("php://input"));

if(!empty($params->id)){
    $student->id= $params->id;
    $student_data = $student->get_single_data();

    print_r( $student_data);
}

}else{
 http_response_code(503); // service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access denied"
    ));
}


?>
