<?php
require 'vendor/autoload.php';

use Page\User;
//error_reporting(E_ALL); ini_set('display_errors', 1);

session_start();
$user_check = $_SESSION['login_user'];
$obj2 = new User();
$check = $obj2->checkadmin($_SESSION['login_user']);
if($check) {
    include_once('signup.php');//conditions are made signup.php so that adduser and signup can use same form
}
else{
    echo"u are not admin pls ask admin";
}