<?php
//namespace autoload\src\controller\controller;
error_reporting(E_ALL); ini_set('display_errors', 1);
use \autoload\src\controller\controller;
// spl_autoload_register(function ($class_name) {
//     include $class_name . '.php';
// });
spl_autoload_register(function ($class_name) {
    //echo $class_name;
    $bs= str_replace('\\', '/', $class_name);
    $var=explode("/",$bs);
    $var[0] = null;
    $var2 = '.' . implode("/", $var);
   include $var2 . '.php';
});

//$obj  = new autoload();
//$obj2 = new Map(); 
//$obj3 = new namespace\controller;

$name = new controller();

?>