<?php

session_start();

require_once("spaceship.php");
require_once("stats.php");

if (!isset($spaceship) || !isset($spaceship2)) {
    $error = "Spaceships aren't set. Go to stats.php to set the stats";
    die($error);
}

function shipAmmoRemaining($ship)
{
    return $ship->weapons->getAmmo();
}

function battleDone() {}

$attacker = $spaceship;
$defender = $spaceship2;

while (true) {
    if ($spaceship->getHP() <= 0 || $spaceship2->getHP() <= 0) break;
    if (shipAmmoRemaining($spaceship) <= 0 && shipAmmoRemaining($spaceship2) <= 0) break;

    $weapons = $attacker->weapons;
    $weaponName = $weapons->getName();
    $ammo = $weapons->getAmmo();

    if ($ammo <= 0) {
        echo $attacker->getName() . " is out of ammo" . "<br>";
    } else {
        // consume one ammo
        $attacker->weapons->ammo = $ammo - 1;

        $hitchance = $weapons->getHitChance();
        $roll = rand(0, 10);
        echo $attacker->getName() . " rolled a " . $roll . " to hit" . "<br>";

        if ($roll >= $hitchance) {
            // It's a hit: calculate damage and apply to shield first, then HP
            $damage = $weapons->getAttackDamage();
            echo "  -> HIT! " . $attacker->getName() . " deals " . $damage . " damage." . "<br>";

            if ($defender->getShield() > 0) {
                $shield = $defender->getShield();
                if ($damage >= $shield) {
                    // shield absorbs part/all of damage
                    $damageAfterShield = $damage - $shield;
                    $defender->shield = 0;
                    echo "    -> " . $shield . " absorbed by shield (shield now 0)." . "<br>";
                    $damage = $damageAfterShield;
                } else {
                    // shield absorbs all damage
                    $defender->shield = $shield - $damage;
                    echo "    -> " . $damage . " absorbed by shield (shield now " . $defender->getShield() . ")." . "<br>";
                    $damage = 0;
                }
            }

            if ($damage > 0) {
                $hp = $defender->getHP();
                $defender->hp = $hp - $damage;
                echo $defender->getName() . " has " . $defender->hp . " hp left" . "<br>";
            } else {
                echo $defender->getName() . " took no hull damage." . "<br>";
            }
        } else {
            echo "  -> MISS! " . $attacker->getName() . " did not hit." . "<br>";
        }
    }

    // swap attacker and defender for next turn
    $temp = $attacker;
    $attacker = $defender;
    $defender = $temp;
}
