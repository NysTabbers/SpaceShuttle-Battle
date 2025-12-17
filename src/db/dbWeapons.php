<?php

session_start();

require_once("dbConnectie.php");

if(!isset($_SESSION["weapons"])){
    $_SESSION["error"] = true;
    header("Location: ../HTML/index.php");
}

$weapons = $_SESSION["weapons"];

$sql = "INSERT INTO weapons (naam, firepower, hitchance, attackDamage, shootRange, ammo, cooldown) VALUES (?, ?, ?, ?, ?, ?, ?)";

?>