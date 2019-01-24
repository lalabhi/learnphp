<?php
spl_autoload_register(function ($class_name) {
       include $class_name . '.php';
});
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
        <input type="email" name="Email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="Password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
</div>
<?php if(isset($_GET['msg']) && $_GET['msg']== FALSE)
              echo '<div class="alert alert-danger">Wrong username or password </div>';
              ?>
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $obj2 = new User();
    $msg=$obj2->login($email, $password);
    if($msg){
        $_SESSION['login_user'] = $msg;
        header("location: welcome.php");
    }
    else{
        header("Location:http://localhost:8888/user/login.php?msg=FALSE");
    }
}

?>