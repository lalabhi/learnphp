<?php
namespace Page;
use Page\DbConnect;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
error_reporting(E_ALL); ini_set('display_errors', 1);
//handles the DB quieres and return accordingly 
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
        return $emailusername; //returns the Email if the account is present.
    }
    else 
    {
        return FALSE;
    }   
  }
  public function register($fname, $email, $pass, $phone, $active, $role){
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
        $sql3 = 'SELECT * FROM details';
        $result=mysqli_query($conn,$sql3);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $sql2 = "INSERT INTO details(fname, pword, email, phoneno, fhash, roles, active) values ('$fname', '$password', '$email', '$phoneno', '$hash', '$role', '$active')";
        $result = mysqli_query($conn, $sql2) or die(mysqli_error($sql2));
        $msg = 1;
        //verify if the account is not created by admin user
        if(!$active){
        $this->verify($email, $hash);
        header("Location:http://localhost:8888/user/signup.php?msg=$msg");//$msg=1 if data is entered 
        } 
        else{
            $msg=3;
            header("Location:http://localhost:8888/user/signup.php?msg=$msg");
        }
    }
    else{
        $msg = 2;
        header("Location:http://localhost:8888/user/signup.php?msg=$msg");
        
    }
    
}
function verify($email, $hash){
    //commenting this function inorder to use phpmailer
    /*
  //php mail function which works perfectly
  $to      = $email; // Send email to our user
  $subject = 'Signup | Verification'; // Give the email a subject 
  $message = '
  
  Thanks for signing up!
  Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
  ------------------------
  Username: '.$name.'
  Password: '.$password.'
  ------------------------
  
  Please click this link to activate your account:
  http://localhost:8888/user/verify.php?email='.$email.'&hash='.$hash.'
  
  '; // Our message above including the link
                      
  $headers = 'From:noreply@newsite.com' . "\r\n"; // Set from headers
  mail($to, $subject, $message, $headers); // Send our email
*/

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'alshayakapoor@gmail.com';                 // SMTP username
    $mail->Password = 'Vrushali@123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('abhisheklal997@gmail.com', 'never reply back');
    $mail->addAddress($email);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Signup | Verification';
    $mail->Body    = 'Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
    
     ------------------------
      Username: '.$name.'
      Password: '.$password.'
     ------------------------
    
     Please click this link to activate your account:
     http://localhost:8888/user/verify.php?email='.$email.'&hash='.$hash.'
    
     '; // Our message above including the link';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
//returns true if the user is active or else sent a msg back to login as unverified
function checkactive($email){
    $db= new DbConnect();
    $conn= $db->conn;
    $email = mysqli_real_escape_string($conn,$email); 
    $sql="SELECT * FROM details WHERE email = '$email' and active='0'";
    $register_user = mysqli_query($conn,$sql) or die(mysqli_error($sql));
    $no_rows = mysqli_num_rows($register_user);
    if($no_rows == 0){
      return TRUE;

    }
    else{
      $msg="Unverified";
      header("Location:http://localhost:8888/user/login.php?msg=$msg");
    }

}
//function only returns if the user is admin
function checkadmin($email){
    $db= new DbConnect();
    $conn= $db->conn;
    $sql="SELECT roles FROM details WHERE email = '$email'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if($row['roles']=='admin'){
        return TRUE;
    }
}
//deleting user
function deleteusr($email) {
    $db= new DbConnect();
    $conn= $db->conn;
    $sql="SELECT * FROM details WHERE email = '$email'";//check if user is present
    $isuser = mysqli_query($conn,$sql) or die(mysqli_error($sql));
    $no_rows = mysqli_num_rows($isuser);
    if($no_rows == 0){
        return FALSE;
    }
      else{
    $sql="DELETE FROM details WHERE email='$email'";//deletes the user
    $result=mysqli_query($conn,$sql);
    return TRUE;
      }
}
//shows all the data
function showalldata($start_from,$limit){
    $db= new DbConnect();
    $conn= $db->conn;
    $sql="SELECT * FROM details LIMIT $start_from,$limit";
    $result=mysqli_query($conn,$sql);
    return $result;
}
//shows data who has a role
function showroledata($role,$start_from,$limit){
    $db= new DbConnect();
    $conn= $db->conn;
    $sql="SELECT * FROM details WHERE roles='$role' LIMIT $start_from,$limit";
    $result=mysqli_query($conn,$sql);
    return $result;
}
//shows data with id as parameter
function showdatauid($uid){
    $db= new DbConnect();
    $conn= $db->conn;
    $sql = "SELECT * FROM details WHERE u_id='$uid'";
    $result= mysqli_query($conn, $sql);
    return $result;
}
//updates user
function updateusr($u_id,$fname, $email, $phone, $roles, $active){
    $db= new DbConnect();
    $conn= $db->conn;
    print_r($fname);
    $sql="UPDATE details
    SET fname = '$fname', phoneno= '$phone',active='$active',roles='$roles',email = '$email'
    WHERE u_id = '$u_id'";
    $result= mysqli_query($conn, $sql);
    return $result;
}

public function getCount()
{
    $db= new DbConnect();
    $conn= $db->conn;
    $sql = "SELECT COUNT(*) as total FROM details";  
    $result= mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $total_records = $row[0];  
    return $total_records;
}

}

?>