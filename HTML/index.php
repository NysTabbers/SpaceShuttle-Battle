<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../PHP/spaceship.php"); 
require_once("../PHP/stats.php");

//show ship stats
echo ("\n{$Spaceship->getName()}");
echo ("\n{$Spaceship->getLength()}");
echo ("\n{$Spaceship->getWidth()}");
echo ("\n{$Spaceship->getHP()}");
echo ("\n{$Spaceship->getGas()}");
echo ("\n{$Spaceship->getShield()}"); 

echo "<br>";

//show weapon stats. Make changes at stats.php
echo ("\n{$Spaceship->weapons->getName()}");
echo ("\n{$Spaceship->weapons->getFirepower()}");
echo ("\n{$Spaceship->weapons->getAttackDamage()}");
echo ("\n{$Spaceship->weapons->getRange()}");
echo ("\n{$Spaceship->weapons->getAmmo()}");
echo ("\n{$Spaceship->weapons->getCooldown()}");

echo "<br>";

//show engine stats. Make changes at stats.php
echo ("\n{$Spaceship->engine->getName()}");
echo ("\n{$Spaceship->engine->getSpeed()}");
echo ("\n{$Spaceship->engine->getAccelaration()}");

?>