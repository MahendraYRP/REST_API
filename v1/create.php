<?php
//headers

//1.header -> access to every site
header("Access-Control-Allow-Origin: *");
//2.method type is json header=> Content-type and body=> application/json
header("Content-type: application/json; charset: UTF-8");
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    //json decode the values to user readable data && data from the body section
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->name) && !empty($data->email) && !empty($data->phone)) {
        //submit data 
        $student->name = $data->name;
        $student->email = $data->email;
        $student->phone = $data->phone;

        if ($student->create_data()) {

            http_response_code(200); // 200 ok
            echo json_encode(array(
                "status" => 1,
                "message" => "Student data inserted"
            ));
        } else {
            http_response_code(500); // internal error
            echo json_encode(array(
                "status" => 0,
                "message" => " Failed To insert the data"
            ));
        }
    } else {
        http_response_code(404); // page not found
        echo json_encode(array(
            "status" => 0,
            "message" => "Not Be Empty"
        ));
    }
} else {
    http_response_code(503); // service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access denied"
    ));
}
?>