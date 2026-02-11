<?php

require_once("spaceship.php");
require_once("stats.php");
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Laad alle available ships in an array
$allShips = [];
if (isset($spaceship)) $allShips[] = $spaceship;
if (isset($spaceship2)) $allShips[] = $spaceship2;
if (isset($spaceship3)) $allShips[] = $spaceship3;

if (count($allShips) < 2) {
    $error = "Not enough ships defined in stats.php";
    die($error);
}

// Determine player selection from session (default to first ship)
$playerIndex = isset($_SESSION['selected_ship_index']) ? intval($_SESSION['selected_ship_index']) : 0;
if ($playerIndex < 0 || $playerIndex >= count($allShips)) $playerIndex = 0;

// choose enemy as the first ship that's not the player
$enemyIndex = 0;
for ($i = 0; $i < count($allShips); $i++) {
    if ($i !== $playerIndex) { $enemyIndex = $i; break; }
}

$playerShip = $allShips[$playerIndex];
$enemyShip = $allShips[$enemyIndex];

echo "Battle: " . $playerShip->getName() . " (player) vs " . $enemyShip->getName() . " (enemy)" . "<br>";

function shipAmmoRemaining($ship)
{
    // Geeft terug hoeveel munitie een schip nog heeft
    $totalAmmo = 0;
    foreach ($ship->weapons as $weapon) {
        $totalAmmo += $weapon->getAmmo();
    }
    return $totalAmmo;
}

function battleDone($a, $b)
{
    // Stop als een van de schepen geen HP meer heeft
    if ($a->getHP() <= 0 || $b->getHP() <= 0) {
        return false;  // Battle stopt
    }
    // Stop als beide schepen geen munitie meer hebben
    if (shipAmmoRemaining($a) <= 0 && shipAmmoRemaining($b) <= 0) {
        return false;  // Battle stopt
    }
    // Anders battle gaat door
    return true;
}

function shipOutOfAmmo($weapon, $attacker) {
    if ($weapon->getAmmo() <= 0) {
        echo $attacker->getName() . " has no ammo for " . $weapon->getName() . " and cannot attack.<br>";
        return false; // weapon cannot fire
    }

    // Reduce ammo by 1 because it will be fired
    $weapon->ammo = $weapon->getAmmo() - 1;
    return true; // weapon can fire
}

// Function of de aanval raakt
function hitChance($attacker, $weapons)
{
    $hitchance = $weapons->getHitChance();
    $roll = rand(0, 10);
    echo $attacker->getName() . " rolled a " . $roll . " to hit" . "<br>";
    return $roll >= $hitchance;
}

function damageToDefender($defender, $damage)
{
    if ($defender->getShield() > 0) {
        $shield = $defender->getShield();

        // Als schade groter is dan shield → rest gaat naar hull
        if ($damage >= $shield) {
            $damageAfterShield = $damage - $shield;
            $defender->shield = 0; //schild is volledig weg
            echo "    -> " . $shield . " absorbed by shield (shield now 0)." . "<br>";
            $damage = $damageAfterShield;
        } else {
            // Schild absorbeert alle schade
            $defender->shield = $shield - $damage;
            echo "    -> " . $damage . " absorbed by shield (shield now " . $defender->getShield() . ")." . "<br>";
            $damage = 0; // Geen schade naar hull
        }
    }
    if ($damage > 0) {
        $hp = $defender->getHP();
        $defender->hp = $hp - $damage;
        echo $defender->getName() . " has " . $defender->hp . " hp left" . "<br>";
    } else {
        echo $defender->getName() . " took no hull damage." . "<br>";
    }
}

function reverseRolls(&$attacker, &$defender)
{
    // Draait rollen om van attacker en defender
    $temp = $attacker;
    $attacker = $defender;
    $defender = $temp;
}


// Stelt aanvaller en verdediger in voor de eerste ronde
$attacker = $playerShip;
$defender = $enemyShip;

// Hoofdgevechtslus
while (battleDone($attacker, $defender)) {

    foreach ($attacker->weapons as $weapon) {
        // check ammo
        $currentAmmo = $weapon->getAmmo();

                // Call the function and check if the weapon can fire
        if (!shipOutOfAmmo($weapon, $attacker)) {
            continue; // skip this weapon, but loop continues for other weapons
        }

        if (hitChance($attacker, $weapon)) {
            // Aanval raakt
            $damage = $weapon->getAttackDamage(); // Basis schade
            echo "  -> HIT! " . $attacker->getName() . " deals " . $damage . " damage with " . $weapon->getName() . "." . "<br>";

            damageToDefender($defender, $damage);
        } else {
            // Aanval mist
            echo "  -> MISS! " . $attacker->getName() . " weapon " . $weapon->getName() . " did not hit." . "<br>";
        }
    }

    // Rollen omwisselen: aanvaller wordt verdediger voor volgende beurt
    reverseRolls($attacker, $defender);
}
