<?php
   session_start();
   include("config.php");
   $db= new DbConnect();
   $conn= $db->conn;
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($conn,"select fname from details where email = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['fname'];
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>