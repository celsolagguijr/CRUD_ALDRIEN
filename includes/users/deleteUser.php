2<?php

include './actions.php';


$data = json_decode(file_get_contents('php://input'), true); //get data



if(!isset($data['id'])){
    echo json_encode([
        "success" => false,
        "code" => 403,
        "msg" => "Invalid Credentials"
    ]);

   return;
}


echo json_encode(delete($data));