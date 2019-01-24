<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
$obj= new session();
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
<h1>Welcome <?php echo $_SESSION['uname']; ?></h1>
<a href="logout.php">logout</a>
</body>
</html>