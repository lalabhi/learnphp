<?php
session_start();
$user_check = $_SESSION['login_user'];
if($user_check)
{
    echo"already logged in".'<a  href="welcome.php"> go to ur site</a>'. $user_check ;
    exit();
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
    <title>Signup</title>
</head>
<body>
<div class="container">
<form class="form-signup" action="signup.php" method="POST">
        <h2 class="form-signin-heading">Sign up</h2>
        <label for="inputName" class="sr-only">Name</label>
        <input type="fname" name="fname" class="form-control" placeholder="Full Name" required >
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="Email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="Password" class="form-control" placeholder="Password" required>
        <label for="mobilenumber" class="sr-only">Phone Number</label>
        <input type="number" name="phoneno" class="form-control" placeholder="Phone Number" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
        
        <?php if($_GET['msg']==1)
            echo '<div class="alert alert-success">Registered Successfully!!</div>';
              else if($_GET['msg']==2)
              echo '<div class="alert alert-danger">Registered Unsuccessfully!!</div>';
              ?>
        
        <a href="login.php"> already have account?</a>
      </form>
</div>
    
</body>
</html>

<?php
include("User.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {   
        $fname= $_POST['fname'];
        $email=$_POST['Email'];
        $pass=$_POST['Password'];
        $phone=$_POST['phoneno'];
        $obj2 = new User();
        $obj2->register($fname, $email, $pass, $phone);
    }

?>