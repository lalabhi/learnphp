<?php
    include("session.php");

    if(!isset($login_session))
{
    echo"Not authorised please login" .'<a  href="login.php">here</a>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Welcome <?php echo $login_session; ?></h1>
</body>
</html>