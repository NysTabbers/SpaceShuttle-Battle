<?php

// Interfaces inladen
require_once("../Interfaces/Iweapon.php");
require_once("../Interfaces/Ispaceship.php");
require_once("../Interfaces/Iengine.php");

// Interfaces gebruiken
use Interfaces\Iweapon;
use Interfaces\Iengine;
use Interfaces\Ispaceship;
use Interfaces\Iroom;
use Interfaces\Iarmory;

// Spaceship class die Ispaceship interface implementeert
class spaceship implements Ispaceship
{
    public string $name;      // Naam van het ruimteschip
    public int $length;       // Lengte van het schip
    public int $width;        // Breedte van het schip
    public int $hp;           // Levenspunten
    public int $gas;          // Brandstof
    public int $shield;       // Schildsterkte
    public array $weapons;    // Wapens aan boord
    public engine $engine;    // Motor van het schip
    public armory $armory;

    // Constructor om een spaceship aan te maken
    public function __construct(string $name, int $length, int $width, int $hp, int $gas, int $shield, array $weapons, engine $engine, armory $armory)
    {
        $this->name = $name;
        $this->length = $length;
        $this->width = $width;
        $this->hp = $hp;
        $this->gas = $gas;
        $this->shield = $shield;
        $this->weapons = $weapons;
        $this->engine = $engine;
        $this->armory = $armory;
    }

    // Geeft de naam van het spaceship terug
    public function getName(): string
    {
        return $this->name;
    }

    // Geeft de lengte terug
    public function getLength(): int
    {
        return $this->length;
    }

    // Geeft de breedte terug
    public function getWidth(): int
    {
        return $this->width;
    }

    // Geeft de hp terug
    public function getHP(): int
    {
        return $this->hp;
    }

    // Geeft de hoeveelheid gas terug
    public function getGas(): int
    {
        return $this->gas;
    }

    // Geeft de shield waarde terug
    public function getShield(): int
    {
        return $this->shield;
    }

    // Zet een nieuwe naam voor het spaceship
    public function __setName(string $name): void
    {
        $this->name = $name;
    }
}

// Weapon class die Iweapon interface implementeert
class weapon implements Iweapon
{
    public string $name;          // Naam van het wapen
    public int $firepower;        // Vuursnelheid
    public int $hitChance;        // Kans om te raken
    public int $attackDamage;     // Schade
    public int $range;            // Bereik
    public int $ammo;             // Aantal kogels
    public int $cooldown;         // Cooldown tijd

    // Constructor voor weapon
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

    // Geeft de naam van het wapen terug
    public function getName(): string
    {
        return $this->name;
    }

    // Geeft de firepower terug
    public function getFirepower(): int
    {
        return $this->firepower;
    }

    // Geeft de hit chance terug
    public function getHitChance(): int
    {
        return $this->hitChance;
    }

    // Geeft de attack damage terug
    public function getAttackDamage(): int
    {
        return $this->attackDamage;
    }

    // Geeft het bereik terug
    public function getRange(): int
    {
        return $this->range;
    }

    // Geeft het aantal ammo terug
    public function getAmmo(): int
    {
        return $this->ammo;
    }

    // Geeft de cooldown terug
    public function getCooldown(): int
    {
        return $this->cooldown;
    }
}

// Engine class die Iengine interface implementeert
class engine implements Iengine
{
    public string $name;          // Naam van de motor
    public int $speed;            // Snelheid
    public int $accelaration;     // Acceleratie

    // Constructor voor engine
    public function __construct(string $name, int $speed, int $accelaration)
    {
        $this->name = $name;
        $this->speed = $speed;
        $this->accelaration = $accelaration;
    }

    // Geeft de naam van de engine terug
    public function getName(): string
    {
        return $this->name;
    }

    // Geeft de snelheid terug
    public function getSpeed(): int
    {
        return $this->speed;
    }

    // Geeft de acceleratie terug
    public function getAccelaration(): int
    {
        return $this->accelaration;
    }
}

class room implements Iroom
{
    public string $name;
    public int $size;
    public int $hp;
    public function __construct(string $name, int $size, int $hp)
    {
        $this->name = $name;
        $this->size = $size;
        $this->hp = $hp;
    }
    // Geeft de naam terug
    public function getName(): string
    {
        return $this->name;
    }
    // Geeft hp terug
    public function getSize(): int
    {
        return $this->size;
    }
    // Geeft de groote terug
    public function getHp(): int
    {
        return $this->hp;
    }
}

class armory extends room implements Iarmory
{
    public int $ammoAmount;
    public int $weaponCount;
    public function __construct(string $name, int $size, int $hp, int $ammoAmount, int $weaponCount)
    {
        $this->name = $name;
        $this->size = $size;
        $this->hp = $hp;
        $this->ammoAmount = $ammoAmount;
        $this->weaponCount = $weaponCount;
    }
    // Geeft de naam terug
    public function getAmmoAmount(): string
    {
        return $this->ammoAmount;
    }
    // Geeft hp terug
    public function getWeaponCount(): int
    {
        return $this->weaponCount;
    }
}
