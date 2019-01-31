<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require 'Pizza.php';
require 'Lunch.php';
use Meals\Lunch;
use Food\Tasty\Pizza;
$lunch = new Lunch();
echo $lunch->getFood()->eat();?>