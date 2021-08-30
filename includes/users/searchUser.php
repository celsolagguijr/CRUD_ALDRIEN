<?php
include './actions.php';



if(!isset($_GET['txtSearch'])){
    echo json_encode([
        "success" => false,
        "code" => 403,
        "msg" => "Invalid Credentials"
    ]);

   return;
}


echo search($_GET);