<?php

// database connection setup, this connection can be seen in SQLyog when you are connecting into the database
    $servername = "localhost"; 
    $username = "root";
    $password = "";
    $db = "crud";
    $GLOBALS['conn']= null; //empty 


//try to connect
    try {
        //pass connection to $GLOBALS['conn'] => this variable will be use in all database transactions
        $GLOBALS['conn'] = new mysqli($servername, $username, $password,$db);
    } catch (\Throwable $th) {
        // if error ocured set $GLOBALS['conn'] VAR. to  null => empty
        $GLOBALS['conn'] = null;
    }
    
?>