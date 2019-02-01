<?php
require 'vendor/autoload.php';

use Page\User;
error_reporting(E_ALL); ini_set('display_errors', 1);

session_start();

$user_check = $_SESSION['login_user'];
$obj2 = new User();
$check = $obj2->checkadmin($_SESSION['login_user']);
if(!$check){
    echo"u are not authorised to this page";//only admins are allowed to this page
    exit();
}
//this will return the data of all the users with that particular id
if(isset($_GET['u_id'])){
    $result = $obj2->showdatauid($_GET['u_id']);
    $row = mysqli_fetch_array($result);
}
else{
    //give empty if there is no id given in the get
    $row['fname']='';
    $row['email']='';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--bootstrap adding-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--bootstrap ending-->
    <title>Edit</title>
</head>
<body>
<div class="container">
<form class="form-signup" action="<?php echo'edit.php?u_id=' . $row['u_id']. '' ?>" method="POST">
        <h2 class="form-signin-heading">Edit</h2>
        <label for="inputName" class="sr-only">Name</label>
       FirstName
        <input type="fname" name="fname" class="form-control"  placeholder="Name" value="<?php echo $row['fname']//adding the values ?>"required ><!-- shows the value-->
        <label for="inputEmail" class="sr-only">Email address</label>
        Email
        <input type="email" name="Email" class="form-control"  placeholder="Email" value="<?php echo $row['email'] ?>" required>
        
        <label for="mobilenumber" class="sr-only">Phone Number</label>
        Number
        <input type="number" name="phoneno" class="form-control" placeholder="Phone No" value="<?php echo $row['phoneno'] ?>"required>
        <label for="roles" class="sr-only"  >Roles</label>
        Roles
        <select class="form-control" name="roles">
        <option value="admin">Admin</option>
        <option value="Member">Member</option>
        <option value="contentwriter">contentwriter</option>
        </select>
        Active
        <select class="form-control" name="active">
        <option value='0'>Inactive</option>
        <option value='1'>Activer</option>
        </select>
        <button class="btn btn-lg btn-primary btn-block" type="submit">submit</button>
      </form>
</div>
</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {   
        $u_id= $row['u_id'];
        $fname= $_POST['fname'];
        $email= $_POST['Email'];
        $phone=$_POST['phoneno'];
        $roles = $_POST['roles'];
        $active = $_POST['active'];
        
        $val=$obj2->updateusr($u_id, $fname, $email, $phone, $roles, $active);
        if($val){
        echo '<div class="alert alert-success">Update Successfully!!</div>';

        }
    }
    ?>