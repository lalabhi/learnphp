<?php
require 'vendor/autoload.php';

use Page\User;

error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
$msg=0;
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
<form class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">Sign In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="Email" class="form-control" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only" >Password</label>
        <input type="password" name="Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" class="form-control" placeholder="Password" required>
        
        <span><input type="checkbox" name="rememberme" value="rememberme">Remember me<br></span>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
</div>
<?php //notification handling for different message
      if(isset($_GET['msg']) && $_GET['msg']== "invalid")
              echo '<div class="alert alert-danger">Wrong username or password </div>';
      else if(isset($_GET['msg']) && $_GET['msg']== "Unverified"){
              echo '<div class="alert alert-danger">Please verify your email </div>';
              session_destroy();
      }
              ?>
</body>
</html>

<?php
//remember me handling
if(!empty($_POST["rememberme"])) {
         
    $hour = time() + 3600 * 24 * 30;
    setcookie("username", $_POST["Email"], $hour);
    setcookie("password", $_POST["Password"], $hour);
}
else {
    if(isset($_COOKIE["username"])) {
        setcookie ("username","");
    }
    if(isset($_COOKIE["password"])) {
        setcookie ("password","");
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $obj2 = new User();
    $msg=$obj2->login($email, $password);
    if($msg){
        //to check if the user had activated his email
        $msg=$obj2->checkactive($email);
        if($msg){
            $_SESSION['login_user'] = $email;
            header("location: welcome.php");
        }
        
    }
    else{
        $msg="invalid";
        header("Location:http://localhost:8888/user/login.php?msg=$msg");
    }
}

?>