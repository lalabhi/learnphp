<?php
namespace Meals;
use Food\Tasty\Pizza;
class Lunch
{
    public function getFood()
    {
        return new Pizza();
    }
}
