<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        $sql2 = "INSERT INTO details(fname, pword, email, phoneno, fhash) values ('$fname', '$password', '$email', '$phoneno', '$hash')";
        $result = mysqli_query($conn, $sql2) or die(mysqli_error($sql2));
        $msg = 1;
        $this->verify($email, $hash);
        header("Location:http://localhost:8888/user/signup.php?msg=$msg");//$msg=1 if data is entered  
    }
    else{
        $msg = 2;
        header("Location:http://localhost:8888/user/signup.php?msg=$msg");//$msg=0 if not
        
    }
    
}
function verify($email, $hash){
  // $to      = $email; // Send email to our user
  // $subject = 'Signup | Verification'; // Give the email a subject 
  // $message = '
  
  // Thanks for signing up!
  // Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
  // ------------------------
  // Username: '.$name.'
  // Password: '.$password.'
  // ------------------------
  
  // Please click this link to activate your account:
  // http://localhost:8888/user/verify.php?email='.$email.'&hash='.$hash.'
  
  // '; // Our message above including the link
                      
  // $headers = 'From:noreply@newsite.com' . "\r\n"; // Set from headers
  // mail($to, $subject, $message, $headers); // Send our email


//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = Email;                 // SMTP username
    $mail->Password = pass;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('abhisheklal997@gmail.com', 'never reply back');
    $mail->addAddress($email);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

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
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
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
}

?>