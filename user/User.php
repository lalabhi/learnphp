<?php
spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});
//error_reporting(E_ALL); ini_set('display_errors', 1);
class User{
    
  public function login($em, $pass){
    $db= new DbConnect();
    $conn= $db->conn;
    $emailusername = mysqli_real_escape_string($conn,$em); 
    $password = mysqli_real_escape_string($conn,$pass); 
    $sql="SELECT * FROM details WHERE email = '$emailusername' and pword='$password'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result)) {  
        return $emailusername; 
    }
    else 
    {
        return FALSE;
    }   
  }
  public function register($fname, $email, $pass, $phone){
    $db= new DbConnect();
    $conn= $db->conn;
    if(isset($login_session))
    {
        header("Location: login.php");
    }
    
        $fname = mysqli_real_escape_string($conn,$fname); 
        $email = mysqli_real_escape_string($conn,$email); 
        $password = mysqli_real_escape_string($conn,$pass); 
        $phoneno = mysqli_real_escape_string($conn,$phone); 
        $sql = "SELECT * from details WHERE email = '$email'";
        $register_user = mysqli_query($conn,$sql) or die(mysqli_error($sql));
        $no_rows = mysqli_num_rows($register_user);

    if($no_rows == 0)
    { 
        $hash = md5( rand(0,1000) );
        $sql2 = "INSERT INTO details(fname, pword, email, phoneno) values ('$fname', '$password', '$email', '$phoneno')";
        $result = mysqli_query($conn, $sql2) or die(mysqli_error($sql2));
        $msg = 1;
        header("Location:http://localhost:8888/user/signup.php?msg=$msg");//$msg=1 if data is entered  
    }
    else{
        $msg = 2;
        header("Location:http://localhost:8888/user/signup.php?msg=$msg");//$msg=0 if not
        
    }
    
}
}

?>