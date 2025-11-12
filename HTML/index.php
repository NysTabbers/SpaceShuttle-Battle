<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../PHP/spaceship.php");

$canon = new weapon("Death Canon", 10, 35, 10, 10, 10);
$Spaceship = new spaceship("Humanitus Invictus", 10, 5, 100, 50, 75, $canon);

echo ("\n{$Spaceship->getInfo()}");

$Spaceship->__setName("voorbeeld");

echo ("\n{$Spaceship->getName()}");

$Spaceship->weapons->getInfo();



?>