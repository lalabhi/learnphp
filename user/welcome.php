<?php
namespace Page;
use Page\session;
use Page\User;
use Page\DbConnect;
require 'vendor/autoload.php';

// spl_autoload_register(function ($class_name) {
//      include $class_name . '.php';
//  });
error_reporting(E_ALL); ini_set('display_errors', 1);
$obj= new session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!--bootstrap adding-->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--bootstrap ending-->
    <title>Document</title>
</head>
<body>
<h1>Welcome <?php echo $_SESSION['uname']; ?></h1>
<!-- logout buttton-->
<a href="logout.php" class="btn btn-info">logout</a> <br/><br/>
<?php 
$obj2 = new User();
$check = $obj2->checkadmin($_SESSION['login_user']);
//if the user is admin show the below container
if($check){
 ?>
    <div class="container">
   <a href="adduser.php" class="btn btn-info" role="button">Add User</a><!--addding user-->
   <button onClick="createDiv()" class="btn btn-danger"> Delete User</button><!--deleting user createDiv(); is a function is js-->
   <div id="getText"  style="display: none;">
   <br/>
   <!--form for getting the email of the user that the admin wish to delete-->
   <form class="form-signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
   <label for="inputEmail" class="sr-only">Email address</label>
        <input style="width:30%; margin-left:30%;" type="email" name="Email" class="form-control" placeholder="Email address" required autofocus>
        <button style="margin-left:30%;"class="btn btn-danger" type="submit">delete user</button>
       </form> 
  </div>
   
   </div>
 <?php   
}
?>
<!--deleting the user-->
<?php 
    if (isset($_POST['Email'])){
        if($_POST['Email']){
        $email = $_POST['Email'];
        $val=$obj2->deleteusr($email);
        if($val){
            echo '<div class="alert alert-success">'.$email.' deleted </div>';
        }
        else{
            echo '<div class="alert alert-danger">'.$email. 'not found </div>';
        }
    }
    } 


?>
<!-- filtering Part-->
<div class="container">
<form class="checkbox" method ="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type="radio" name="filter" value="#" >Show All<br>
  <input type="radio" name="filter" value="admin"> Show Admin<br>
  <input type="radio" name="filter" value="member"> Show members  
  <br><button class="btn btn-info">showdata</button>
</form> 
</div>
<?php 
//checking if user is a admin inorder to proceed with filtering
if($check){
    //checking if post is happening
    if(isset($_POST['filter'])){   
    if($_POST['filter'] == 'admin') {
        $result = $obj2->showroledata($_POST['filter']);
    }
    else if($_POST['filter'] == 'member') {
        $result = $obj2->showroledata($_POST['filter']);
    }
    else{
        $result = $obj2->showalldata();   
    }
}
if(isset($result)){
echo"<br> <br> <br>";
echo'<div class="container">';
echo '<table  class="table table-striped">';

echo "<tr> <th>u_id</th> <th>Name</th> <th>Email</th> <th>Phoneno</th> <th>active</th> <th>roles</th> <th>Update</th></tr>";
while($row = mysqli_fetch_array( $result )) {



    // echo out the contents of each row into a table
    
    echo "<tr>";
    
    echo '<td>' . $row['u_id'] . '</td>';
    
    echo '<td>' . $row['fname'] . '</td>';
    
    echo '<td>' . $row['email'] . '</td>';

    echo '<td>' . $row['phoneno'] . '</td>';

    echo '<td>'.$row['active']. '</td>';

    echo '<td>' . $row['roles'] . '</td>';
    
    echo '<td><a href="edit.php?u_id=' . $row['u_id']. '">Edit</a></td>';//creating the link to edit each and every user
    
    echo "</tr>";
    
    }
    
    
    
    // close table>
    
    echo "</table>";
    echo "</div>";
}
}
    ?>
</body>
<!--function for create the form div for deleting the user-->
<script>
  function createDiv() {
    var div = document.createElement('div');
    div.innerHTML = document.getElementById('getText').innerHTML;
    document.body.appendChild(div);
  }
</script>
</html>
