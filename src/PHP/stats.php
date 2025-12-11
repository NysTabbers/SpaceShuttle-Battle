<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../PHP/spaceship.php"); 

//weapon stats
$laser = new weapon("Light Laser", 10, 3, 30, 200, 50, 15);
$canon = new weapon("Death Canon", 3, 6, 50, 150, 20, 30);
$superWeapon = new weapon("Doom", 1, 7, 100, 200, 10, 30);

//engine stats
$engine = new engine("TR-08", 100, 50);
$engine2 = new engine("TR-07", 65, 20);
$engine3 = new engine("HE-01", 30, 10);

//spaceship stats
$spaceship = new spaceship("Humanitus Invictus", 125, 50, 250, 150, 100, [$laser, $canon], $engine);
$spaceship2 = new spaceship("Deystroyer", 150, 100, 250, 150, 100, [$canon, $laser], $engine2);
$spaceship3 = new spaceship("Galacticus", 500, 375, 350, 150,  100, [$superWeapon, $canon], $engine3);

?>