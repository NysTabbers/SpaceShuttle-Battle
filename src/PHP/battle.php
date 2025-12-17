<?php

require_once("spaceship.php");
require_once("stats.php");
// Laad de definities van ruimteschepen en hun stats

// Check of beide ruimteschepen zijn ingesteld
if (!isset($spaceship) || !isset($spaceship2)) {
    $error = "Spaceships aren't set. Go to stats.php to set the stats";
    die($error);
    // Stop script als stats ontbreken
}

function shipAmmoRemaining($ship)
{
    // Geeft terug hoeveel munitie een schip nog heeft
    $totalAmmo = 0;
    foreach ($ship->weapons as $weapon) {
        $totalAmmo += $weapon->getAmmo();
    }
    return $totalAmmo;
}

function battleDone($spaceship, $spaceship2)
{
    // Stop als een van de schepen geen HP meer heeft
    if ($spaceship->getHP() <= 0 || $spaceship2->getHP() <= 0) {
        return false;  // Battle stopt
    }
    // Stop als beide schepen geen munitie meer hebben
    if (shipAmmoRemaining($spaceship) <= 0 && shipAmmoRemaining($spaceship2) <= 0) {
        return false;  // Battle stopt
    }
    // Anders battle gaat door
    return true;
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
$attacker = $spaceship;
$defender = $spaceship2;

// Hoofdgevechtslus
while (battleDone($spaceship, $spaceship2)) {

    foreach ($attacker->weapons as $weapon) {
        // check ammo
        $currentAmmo = $weapon->getAmmo();

        if ($currentAmmo <= 0) {
            echo $attacker->getName() . " tried to fire " . $weapon->getName() . " but it's out of ammo.<br>";
            continue;
        }
        
        // Haal ammo weg wanneer raakgeschoten
        $weapon->ammo = $currentAmmo - 1;

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
