<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../PHP/spaceship.php"); 

$canon = new weapon("Death Canon", 3, 35, 1000, 10, 25);
$Spaceship = new spaceship("Humanitus Invictus", 10, 5, 100, 75, 50,$canon);

//ship stats
echo ("\n{$Spaceship->getName()}");
echo ("\n{$Spaceship->getLength()}");
echo ("\n{$Spaceship->getWidth()}");
echo ("\n{$Spaceship->getHP()}");
echo ("\n{$Spaceship->getGas()}");
echo ("\n{$Spaceship->getShield()}"); 

echo "<br>";

//weapon stats
echo ("\n{$Spaceship->weapons->getName()}");
echo ("\n{$Spaceship->weapons->getFirepower()}");
echo ("\n{$Spaceship->weapons->getAttackDamage()}");
echo ("\n{$Spaceship->weapons->getRange()}");
echo ("\n{$Spaceship->weapons->getAmmo()}");
echo ("\n{$Spaceship->weapons->getCooldown()}");
?>