<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <!-- all CSS -->
    <?php include '../../layout/css.php' ?> 
     <!-- all CSS -->
</head>
<body>

<?php
    // check if user is already login
    include '../../includes/SpecialFunctions.php';
    session_start();
    //if auth ok goto users
    if(!checkAuth()){
        header('Location:  ../login');
    }
?>

     <div class="container mb-2">
        <?php include '../../layout/navigation.php' ?> 
     </div>


    <div class="container">
        <!-- page content here! -->
        <?php include './content.php' ?>
        <?php include './addModal.php' ?>
        <?php include './editModal.php' ?>
        <!-- page content here! -->
    </div>


<!-- All Javascript! -->
<?php include '../../layout/scripts.php' ?>
<!-- All Javascript! -->
    
</body>
</html>



