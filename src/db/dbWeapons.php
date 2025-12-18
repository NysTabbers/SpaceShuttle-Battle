<?php
// dbWeapons.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("dbConnectie.php");
require_once("../PHP/spaceship.php");
session_start();

function insertWeapons($conn, $weapons) {
    if (empty($weapons)) return;

    try {
        $stmt = $conn->prepare(
            "INSERT INTO weapons (naam, firepower, hitchance, attackDamage, shootRange, ammo, cooldown) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        foreach ($weapons as $weapon) {
            $name = $weapon->getName();
            $firepower = $weapon->getFirepower();
            $hitchance = $weapon->getHitChance();
            $attackDamage = $weapon->getAttackDamage();
            $range = $weapon->getRange();
            $ammo = $weapon->getAmmo();
            $cooldown = $weapon->getCooldown();

            $stmt->bind_param(
                "siiiiii",
                $name,
                $firepower,
                $hitchance,
                $attackDamage,
                $range,
                $ammo,
                $cooldown
            );
            $stmt->execute();
        }
    } catch (Exception $e) {
        die("Insert Error: " . $e->getMessage());
    } finally {
        if (isset($stmt)) $stmt->close();
    }
}

function getWeapons($conn) {
    $weapons = [];
    try {
        $result = $conn->query("SELECT * FROM weapons");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $weapons[] = $row;
            }
            $result->free();
        }
    } catch (Exception $e) {
        die("Get Weapons Error: " . $e->getMessage());
    }
    return $weapons;
}

function updateWeapons($conn) {
    try {
        $result = $conn->query("SELECT * FROM weapons");
        if ($result) {
            while ($weapon = $result->fetch_assoc()) {
                $firepower = $weapon['firepower'] + 1;
                $hitchance = $weapon['hitchance'] + 1;
                $attackDamage = $weapon['attackDamage'] + 1;
                $range = $weapon['shootRange'] + 1;
                $ammo = $weapon['ammo'] + 1;
                $cooldown = $weapon['cooldown'] + 1;
                $id = $weapon['id'];

                $stmt = $conn->prepare(
                    "UPDATE weapons SET firepower=?, hitchance=?, attackDamage=?, shootRange=?, ammo=?, cooldown=? WHERE id=?"
                );

                $stmt->bind_param(
                    "iiiiiii",
                    $firepower,
                    $hitchance,
                    $attackDamage,
                    $range,
                    $ammo,
                    $cooldown,
                    $id
                );
                $stmt->execute();
                $stmt->close();
            }
        }
    } catch (Exception $e) {
        die("Update All Weapons Error: " . $e->getMessage());
    }
}

function deleteAllWeapons($conn) {
    try {
        $conn->query("DELETE FROM weapons");
        $conn->query("ALTER TABLE weapons AUTO_INCREMENT = 1");
    } catch (Exception $e) {
        die("Delete All Weapons Error: " . $e->getMessage());
    }
}
?>
