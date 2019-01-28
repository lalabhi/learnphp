<?php 

require 'vendor/autoload.php';
use Page\DbConnect;
error_reporting(E_ALL); ini_set('display_errors', 1);
// spl_autoload_register(function ($class_name) {
//     include $class_name . '.php';
// });
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body>
    <?php
        $db= new DbConnect();
        $conn= $db->conn;
        //print_r($conn);
        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
            // Verify data
            $email = mysqli_real_escape_string($conn,$_GET['email']); // Set email variable
            $hash = mysqli_real_escape_string($conn,$_GET['hash']); // Set hash variable
            $sql="SELECT email, fhash, active FROM details WHERE email = '$email' and fhash='$hash' and active='0'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            if(mysqli_num_rows($result)) {  
                mysqli_query($conn,"UPDATE details SET active='1' WHERE email='$email' and fhash='$hash' and active='0'") or die(mysql_error());
                echo '<div class="alert alert-success">Your account has been activated, you can now <a href="login.php">login</a></div>';
            }
            else 
            {
                echo '<div class="alert alert-danger">Something gone wrong</div>';
            }   
            }
    ?>
</body>
</html>