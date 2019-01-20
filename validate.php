<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
$name = $email = $gender = $comment = $website = "";
$eerror = $eemail="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $eerror = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $eerror = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $eemail = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $eemail = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $ewebsite = "Invalid URL"; 
    }
  }
  $comment = test_input($_POST["comment"]);
  $gender = test_input($_POST["gender"]);
}

function test_input($anand) {
  $data = trim($anand);
  $data = stripslashes($anand);
  $data = htmlspecialchars($anand);
  
  return $data;
}

//if($name == "" || $email == "" || $website=="" || $comment =="" || $gender==""){
  //  echo"<script>alert('cant be empty');</script>";
//}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name"> <span> <?php echo $eerror;?></span>
  <br><br>
  E-mail: <input type="text" name="email"><span> <?php echo $eemail;?></span>
  <br><br>
  Website: <input type="text" name="website"><?php echo $ewebsite;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>