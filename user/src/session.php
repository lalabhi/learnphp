<?php
namespace Page;
error_reporting(E_ALL); ini_set('display_errors', 1);

// spl_autoload_register(function ($class_name) {
//         include $class_name . '.php';
//  });
//  error_reporting(E_ALL); ini_set('display_errors', 1);

   class session{
      function __construct(){

         session_start();
         include("DbConnect.php");
         $db= new DbConnect();
         $conn= $db->conn;
         $user_check = $_SESSION['login_user'];
         $ses_sql = mysqli_query($conn,"select fname from details where email = '$user_check' ");
         $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
         $_SESSION['uname'] = $row['fname'];
         if(!isset($_SESSION['login_user'])){
            header("location:login.php");
            die();
         }
      
      }
}
?>