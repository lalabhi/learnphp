<?php

include("config.php");

class trial{
   
    function tri() {
        $classa = new DbConnect();
        $x = $classa->DbConn('localhost', 'root', 'root', 'loginapp');
        print_r($x);
    }

    
} 
$classB = new trial();
print_r($classB->tri());

?>