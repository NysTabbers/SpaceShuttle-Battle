<?php
header('Content-Type: application/json');

// Load stats which defines $spaceship, $spaceship2, $spaceship3
require_once(__DIR__ . "/stats.php");

$ships = [];
$objects = [];
if (isset($spaceship)) $objects[] = $spaceship;
if (isset($spaceship2)) $objects[] = $spaceship2;
if (isset($spaceship3)) $objects[] = $spaceship3;

foreach ($objects as $s) {
    $weapons = [];
    foreach ($s->weapons as $w) {
        $weapons[] = [
            'name' => $w->getName(),
            'firepower' => $w->getFirepower(),
            'hitChance' => $w->getHitChance(),
            'attackDamage' => $w->getAttackDamage(),
            'range' => $w->getRange(),
            'ammo' => $w->getAmmo(),
            'cooldown' => $w->getCooldown()
        ];
    }

    $engine = null;
    if (isset($s->engine)) {
        $engine = [
            'name' => $s->engine->getName(),
            'speed' => $s->engine->getSpeed(),
            'acceleration' => $s->engine->getAccelaration()
        ];
    }

    $armory = null;
    if (isset($s->armory)) {
        $armory = [
            'ammoAmount' => $s->armory->getAmmoAmount(),
            'weaponCount' => $s->armory->getWeaponCount(),
            'size' => $s->armory->getSize(),
            'hp' => $s->armory->getHp()
        ];
    }

    $ships[] = [
        'name' => $s->getName(),
        'length' => $s->getLength(),
        'width' => $s->getWidth(),
        'hp' => $s->getHP(),
        'gas' => $s->getGas(),
        'shield' => $s->getShield(),
        'weapons' => $weapons,
        'engine' => $engine,
        'armory' => $armory
    ];
}

echo json_encode($ships);
