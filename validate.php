<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
$name = $email = $gender = $comment = $website = "";
$eerror = $eemail="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(empty($_POST["name"])){
    $eerror="can't be empty";
  }
  else{
  $name = test_input($_POST["name"]);
  }
  if(empty($_POST["email"])){
    $eemail="u can't give empty email";
  }
  else{
    $email = test_input($_POST["email"]);
    if (!strpos($email, '@')) {
      $eemail="Not a valid email";
      $email=" ";
      reload();
  }
  }
  $website = test_input($_POST["website"]);
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
  Website: <input type="text" name="website">
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