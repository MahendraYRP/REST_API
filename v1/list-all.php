<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

include_once("../config/database.php");
include_once("../classes/student.php");

$db = new Database();
$connect =   $db->connect();

$student = new Student($connect);

 if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $data = $student->get_all_data();

    if ($data->num_rows > 0) {
        
        $students["records"] = array();
         //convert each and every array
        while ($row = $data->fetch_assoc()) {

            //push all the rows inside the student["records"] variable
            array_push($students["records"], array(
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "phone" => $row['phone'],
                "status" => $row['status'],
                "create_at" => date("Y-m-d", strtotime($row['create_at']))
            ));
        }
        http_response_code(200); 
        echo json_encode(array(
            "status" => 1,
            "data" => $students["records"]
        ));
    }
} else {
    http_response_code(503); 
    echo json_encode(array(
        "status" => 0,
        "message" => "Access denied"
    ));
}
