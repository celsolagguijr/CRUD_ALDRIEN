<?php

include './actions.php';


$data = json_decode(file_get_contents('php://input'), true);


if(!isset($data['username']) || !isset($data['password'])){
    echo json_encode([
        "success" => false,
        "code" => 403,
        "msg" => "Invalid Credentials"
    ]);

   return;
}


echo login($data['username'] ,$data['password']);