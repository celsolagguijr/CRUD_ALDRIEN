<?php
include "../SpecialFunctions.php";

function login($username,$password){

    // SQL to find the user base on the entered username 
    $q = "SELECT * FROM users WHERE UserName ='$username'";
    //fetch data , this is not a global function. you may check the code in SpecialFunctions
    //https://www.w3schools.com/php/php_mysql_select.asp
    $result = runSQL($q); 

    //server error
    if(!$result["success"]){
        return json_encode($result);
    }

    //no found data return 404    
    if(count($result['data']) <= 0) {
        return json_encode(notFound("User not exist!"));
    }

    //validate password , data is array just get the first array and get the password object
    $savedPassword = $result['data'][0]->Password;
    if(!validatePassword($password, $savedPassword)){
        return json_encode(incorrectCredentials("Incorrect username or password"));
    }



    //save login credentials to be us in filterings and displaying of user info in the dashboard
    sessionStart([
        'id' => $result['data'][0]->id,
        'name' => $result['data'][0]->FirstName. " " .$result['data'][0]->LastName,
        'username' => $result['data'][0]->UserName
    ]);


    //correct credentials
    return json_encode( [
        "success" => true,
        "code" => 200,
        "msg" => 'Access Granted!'
    ]);
    
}


function loadUsers ()  {

    $q = "SELECT id,FirstName,LastName,UserName FROM users";

    //run sql
    $result = runSQL($q); 

    //server error
    if(!$result["success"]){
        return json_encode($result);
    }

    //correct credentials
    return json_encode( [
        "success" => true,
        "code" => 200,
        "msg" => "Success",
        "data" => $result['data']
    ]);

}


// function create($data) {




    



// }


// function edit($data) {

// }


// function delete($data) {

// }


// function connect($id) {

// }

?>