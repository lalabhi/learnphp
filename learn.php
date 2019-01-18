<!DOCTYPE html>
<html lang="en">
<head>
    <title>Learn PHP</title>
</head>
<body>
<h1>Lets do php</h1>
<?php
$x = 5 /* + 15 */ +5;
echo $x;

$color = "red";
echo "My car is " . $color . "<br>";
echo "My house is " . $COLOR . "<br>";
echo "My boat is " . $coLOR . "<br>";

echo "My car is $color <br>";

$x = 5;
$y = 6;

echo $x+$y;
echo "<br>";
 
function test(){
    $x =10;
    echo "I am inside function x:$x";
    global $z;
    $z = $x*$x; 
}
test();
echo "<br> value of global z:$z";
print "<br> value in print $z";
echo"<br>";
$x = 5985;
var_dump($x);
var_dump($color);
echo"<br>";
$var=array("volo", "BMW", "toyota");
var_dump($var);
echo"<br> print the array value  $var[1]";

class car{
    function car(){
        $this->name="BENZ";
    }
}
$nc = new car();
echo"<br> <h1>$nc->name</h1>";

define("r", "this is php ppl");

function myTest() {
    echo r;
}
 
myTest();

echo"<br>";

$t = date("H");

if ($t < "20") {
    echo "Have a good day! <br><br>";
}


sort($var);

$clength = count($var);
for($x = 0; $x < $clength; $x++) {
    echo $var[$x];
    echo "<br>";
}



$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
asort($age);

foreach($age as $x=> $value){
    echo "Key=" . $x . ", Value=" . $value;
    echo "<br>";

}
?>

    
</body>
</html>