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
        <!--<label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>-->
        <label for="mobilenumber" class="sr-only">Phone Number</label>
        <input type="number" name="phoneno" class="form-control" placeholder="Phone Number" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
        <a href="login.php"> already have account?</a>
      </form>
</div>
    
</body>
</html>

<?php
include("config.php");
print_r("hello");
class registeration{
    public function register(){
        $obj = new DbConnect();
        $conn= $obj->DbConn('localhost', 'root', 'root', 'loginapp');
        print_r("hello");
        if(isset($login_session))
        {
            header("Location: login.php");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $fname = mysqli_real_escape_string($conn,$_POST['fname']); 
            $email    = mysqli_real_escape_string($conn,$_POST['Email']); 
            $password = mysqli_real_escape_string($conn,$_POST['Password']); 
            $phoneno     = mysqli_real_escape_string($conn,$_POST['phoneno']); 
            


            $sql ="SELECT * from details WHERE email = '$email'";
            $register_user = mysqli_query($conn,$sql) or die(mysqli_error($sql));
            $no_rows = mysqli_num_rows($register_user);

        if($no_rows == 0)
        {
            $sql2 = "INSERT INTO details(fname, pword, email, phoneno) values ('$fname', '$password', '$email', '$phoneno')";
            $result = mysqli_query($conn, $sql2) or die(mysqli_error($sql2));
            echo "Registration Successfull!";
        }
        else{
            echo "Registration Failed.";
        }
        }
    }
}
$obj2 = new registeration();
$obj2->register();

?>