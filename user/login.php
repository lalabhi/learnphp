
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
</body>
</html>
<?php
include("config.php");
class user{
    
    public function login(){

        $obj = new DbConnect();
        $conn= $obj->DbConn('localhost', 'root', 'root', 'loginapp');
        //print_r($conn);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            print_r($conn);
            
            $emailusername = mysqli_real_escape_string($conn,$_POST['Email']); 
            $password = mysqli_real_escape_string($conn,$_POST['Password']); 

           
            $sql="SELECT * FROM details WHERE email = '$emailusername' and pword='$password'";
            
            $result=mysqli_query($conn,$sql);
            
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active=$row['active'];
            $count=mysqli_num_rows($result);
            if($count==1)
            {
                $_SESSION['login_user'] = $emailusername;
                header("location: welcome.php");
                echo"done";
            }
            else 
            {
                $error="Your Login Name or Password is invalid";
                echo"Invalid username or password";
            }
        }
    }
}
$obj2 = new user();
$obj2->login();

?>