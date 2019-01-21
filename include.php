<html>
<body>
<!--
<div class="form">
<//?php include 'validate.php';?>
</div>
-->
<h1>Welcome to my page!</h1>
</p>

<?php 
    //echo readfile("dict.txt");
    $myfile = fopen("dict.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("dict.txt"));
    fclose($myfile);

    
?>

</body>
</html>