<?php

session_start(); 
// Start een nieuwe sessie of hervat een bestaande sessie (nodig om data tussen pagina's te bewaren)

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
    return $ship->weapons->getAmmo();
}

function battleDone() {} 
// Lege functie; lijkt bedoeld voor toekomstig gebruik (bijv. einde van gevecht)

// Stelt aanvaller en verdediger in voor de eerste ronde
$attacker = $spaceship;
$defender = $spaceship2;

// Hoofdgevechtslus
while (true) {
    // Stop als een van de schepen geen HP meer heeft
    if ($spaceship->getHP() <= 0 || $spaceship2->getHP() <= 0) break;
    // Stop als beide schepen geen munitie meer hebben
    if (shipAmmoRemaining($spaceship) <= 0 && shipAmmoRemaining($spaceship2) <= 0) break;

    $weapons = $attacker->weapons;    // Verkrijg wapenobject van het aanvallende schip
    $weaponName = $weapons->getName(); // Naam van het wapen (nog niet gebruikt)
    $ammo = $weapons->getAmmo();       // Huidige hoeveelheid munitie

    // Als geen munitie → beurt overslaan
    if ($ammo <= 0) {
        echo $attacker->getName() . " is out of ammo" . "<br>";
    } else {
        // Gebruik één munitiepunt
        $attacker->weapons->ammo = $ammo - 1;

        // Bepaal of de aanval raakt
        $hitchance = $weapons->getHitChance(); // Minimale worp die nodig is om te raken
        $roll = rand(0, 10);                   // Willekeurige worp tussen 0 en 10
        echo $attacker->getName() . " rolled a " . $roll . " to hit" . "<br>";

        if ($roll >= $hitchance) {
            // Aanval raakt
            $damage = $weapons->getAttackDamage(); // Basis schade
            echo "  -> HIT! " . $attacker->getName() . " deals " . $damage . " damage." . "<br>";

            // Eerst shields aftrekken
            if ($defender->getShield() > 0) {
                $shield = $defender->getShield();

                // Als schade groter is dan shield → rest gaat naar hull
                if ($damage >= $shield) {
                    $damageAfterShield = $damage - $shield;
                    $defender->shield = 0; // Schild is volledig weg
                    echo "    -> " . $shield . " absorbed by shield (shield now 0)." . "<br>";
                    $damage = $damageAfterShield;
                } else {
                    // Schild absorbeert alle schade
                    $defender->shield = $shield - $damage;
                    echo "    -> " . $damage . " absorbed by shield (shield now " . $defender->getShield() . ")." . "<br>";
                    $damage = 0; // Geen schade naar hull
                }
            }

            // Overgebleven schade naar hull HP
            if ($damage > 0) {
                $hp = $defender->getHP();
                $defender->hp = $hp - $damage;
                echo $defender->getName() . " has " . $defender->hp . " hp left" . "<br>";
            } else {
                echo $defender->getName() . " took no hull damage." . "<br>";
            }
        } else {
            // Aanval mist
            echo "  -> MISS! " . $attacker->getName() . " did not hit." . "<br>";
        }
    }

    // Rollen omwisselen: aanvaller wordt verdediger voor volgende beurt
    $temp = $attacker;
    $attacker = $defender;
    $defender = $temp;
}