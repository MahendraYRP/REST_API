<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include_once("../config/database.php");
include_once("../classes/users.php");




$db = new Database();

$user_obj = new Users($db);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->name) && !empty($data->email) && !empty($data->password)) {
        

        $user_obj->name = $data->name;
        $user_obj->email = $data->email;
        $user_obj->password = $data->password;

        if ($user_obj->create_user()) {
            http_response_code(200);
            echo json_encode($user_obj);
        }else{
            http_response_code(500);
            echo json_encode(array(
                "status"=>0,
                "message"=>"Failed to save user",
            ));
        }

    }else{
        http_response_code(500);
        echo json_encode(array(
            "status"=>0,
            "message"=>"All data needed"
        ));
    }

}else{
    http_response_code(503);
    echo json_encode(array(
        "status"=>0,
        "message"=>"Access Denined"
    ));
}


//headers





?>