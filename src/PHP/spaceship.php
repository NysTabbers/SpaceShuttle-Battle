<?php

require_once("../Interfaces/Iweapon.php");
require_once("../Interfaces/Ispaceship.php");
require_once("../Interfaces/Iengine.php");

use Interfaces\Iweapon;
use Interfaces\Iengine;
use Interfaces\Ispaceship;

class spaceship implements Ispaceship
{
    public string $name;
    public int $length;
    public int $width;
    public int $hp;
    public int $gas;
    public int $shield;
    public array $weapons;
    public engine $engine;
    public function __construct(string $name, int $length, int $width, int $hp, int $gas, int $shield, array $weapons, engine $engine)
    {
        $this->name = $name;
        $this->length = $length;
        $this->width = $width;
        $this->hp = $hp;
        $this->gas = $gas;
        $this->shield = $shield;
        $this->weapons = $weapons;
        $this->engine = $engine;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getLength(): int
    {
        return $this->length;
    }
    public function getWidth(): int
    {
        return $this->width;
    }
    public function getHP(): int
    {
        return $this->hp;
    }
    public function getGas(): int
    {
        return $this->gas;
    }
    public function getShield(): int
    {
        return $this->shield;
    }
    public function __setName(string $name): void
    {
        $this->name = $name;
    }
}

class weapon implements Iweapon
{
    public string $name;
    public int $firepower;
    public int $hitChance;
    public int $attackDamage;
    public int $range;
    public int $ammo;
    public int $cooldown;

    public function __construct(string $name, int $firepower, int $hitChance, int $attackDamage, int $range, int $ammo, int $cooldown)
    {
        $this->name = $name;
        $this->firepower = $firepower;
        $this->hitChance = $hitChance;
        $this->attackDamage = $attackDamage;
        $this->range = $range;
        $this->ammo = $ammo;
        $this->cooldown = $cooldown;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getFirepower(): int
    {
        return $this->firepower;
    }
    public function getHitChance(): int
    {
        return $this->hitChance;
    }
    public function getAttackDamage(): int
    {
        return $this->attackDamage;
    }
    public function getRange(): int
    {
        return $this->range;
    }
    public function getAmmo(): int
    {
        return $this->ammo;
    }
    public function getCooldown(): int
    {
        return $this->cooldown;
    }
}

class engine implements Iengine
{
    public string $name;
    public int $speed;
    public int $accelaration;

    public function __construct(string $name, int $speed, int $accelaration)
    {
        $this->name = $name;
        $this->speed = $speed;
        $this->accelaration = $accelaration;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getSpeed(): int
    {
        return $this->speed;
    }
    public function getAccelaration(): int
    {
        return $this->accelaration;
    }
}
