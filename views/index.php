<?php


include '../includes/SpecialFunctions.php';

session_start();

//if not yet login redirect to login
if(!checkAuth()){
    header('Location:  ./login');
    return;
}

//redirect to users
header('Location:  ./users');

?>