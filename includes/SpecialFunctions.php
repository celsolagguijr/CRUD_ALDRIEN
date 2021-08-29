<?php
include "../DbConnection.php";

function encrypt ($password) {
    $options = [
        'cost' => 10,
    ];

    return password_hash($password, PASSWORD_BCRYPT, $options);   
}


function validatePassword ($enteredPass,$savedPass) {
    return password_verify($enteredPass,$savedPass);
}


function serverError() {

    return [
        "success" => false,
        "code" => 500,
        "msg" => "Something went wrong"
    ];
 }

 function notFound($msg) {

    return [
        "success" => false,
        "code" => 404,
        "msg" => $msg
    ];
 }


 function incorrectCredentials($msg) {

    return [
        "success" => false,
        "code" => 403,
        "msg" => $msg
    ];
 }

//https://www.w3schools.com/php/php_mysql_select.asp
 function runSQL($sql){

    try {
        $res=$GLOBALS['conn']->query($sql);
        $array=array();
        while($data=mysqli_fetch_object($res)){
            $array[]=$data;
        }
    
        return [
            "success" => true,
            "data" => $array
        ];


    } catch (\Throwable $th) {
       return serverError();
    }
 }

 function sessionStart($data) {
    session_start();
    $_SESSION['authCredentials'] = $data;
    
 }

?>