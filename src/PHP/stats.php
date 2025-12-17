<?php

session_start();

// Zet alle PHP foutmeldingen aan
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Laad de spaceship, weapon en engine classes
require_once("../PHP/spaceship.php");

// ====================
// Weapon stats
// ====================

// Licht laserwapen met gemiddelde schade en veel ammo
$laser = new weapon("Light Laser", 10, 3, 30, 200, 50, 15);

// Zwaar kanon met hoge schade maar minder ammo
$canon = new weapon("Death Canon", 3, 6, 50, 150, 20, 30);

// Superwapen met extreem hoge schade en lage vuursnelheid
$superWeapon = new weapon("Doom", 1, 7, 100, 200, 10, 30);

$_SESSION['weapons'] = [$laser, $canon, $superWeapon];

// ====================
// Engine stats
// ====================

// Snelle motor met hoge acceleratie
$engine = new engine("TR-08", 100, 50);

// Gemiddelde motor
$engine2 = new engine("TR-07", 65, 20);

// Langzame motor met lage acceleratie
$engine3 = new engine("HE-01", 30, 10);

// ====================
// Spaceship stats
// ====================

// Menselijk ruimteschip met gebalanceerde stats
$spaceship = new spaceship("Humanitus Invictus", 125, 50, 250, 150, 100, [$laser, $canon], $engine);

// Vijandelijk schip met andere motor en wapenvolgorde
$spaceship2 = new spaceship("Deystroyer", 150, 100, 250, 150, 100, [$canon, $laser], $engine2);

// Groot eindbaas-schip met superwapen
$spaceship3 = new spaceship("Galacticus", 500, 375, 350, 150,  100, [$superWeapon, $canon], $engine3);
