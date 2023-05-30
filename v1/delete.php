<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");

include_once("../config/database.php");
include_once("../classes/student.php");

$db = new Database();
$connect =   $db->connect();
$student = new Student($connect);


if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    

$deleteId = isset($_GET['id'])? $_GET['id']: "";

if (!empty($deleteId)) {
    $student->id = $deleteId;

if ($student->delete_data()) {
   
    http_response_code(200);
    echo json_encode(array(
        "status"=>1,
        "message"=>"student date is deleted",
    ));


}else{
    http_response_code(500);
    echo json_encode(array(
       "status"=>0,
       "message"=> "data not deleted 123",
    ));
}


}else{
    http_response_code(404);
    echo json_encode(array(
        "status"=>0,
        "message"=>"value not be Empty",
    ));
} 


} else{
    http_response_code(503);
    echo json_encode(array(
        "status"=>0,
        "message"=>"access denid",
    ));
}


?>