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


function create($data) {

    $fName = $data["fName"];
    $lName = $data["lName"];
    $uName = $data["uName"];
    $pass = encrypt($data["password"]);

    $q = "INSERT INTO users set FirstName ='$fName', LastName='$lName' , Username='$uName', `Password` ='$pass';";
    return execute($q);
    // echo json_encode( create(["fName" => "celso","lName" => "laggui","uName" => "sample","password" =>"admin"]))
}


function edit($data) {
    
    $id = $data["id"];
    $fName = $data["fName"];
    $lName = $data["lName"];
    $uName = $data["uName"];

    //UPDATE SQL
    $q = "UPDATE users SET FirstName ='$fName', LastName='$lName' , Username='$uName' WHERE  id = '$id'";
    return execute($q);


}


function delete($id) {
    //delete SQL
    $q = "DELETE FROM users WHERE id ='$id'";
    return execute($q);

}


// echo json_encode( edit(["fName" => "celso","lName" => "laggui","uName" => "sss","password" =>"admin","id" => 1]))

// function connect($id) { 

// }

?>