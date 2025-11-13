<?php
class spaceship
{
    public string $name;
    public int $length;
    public int $width;
    public int $hp;
    public int $gas;
    public int $shield;
    public weapon $weapons;
    public function __construct(string $name, int $length, int $width, int $hp, int $gas, int $shield, weapon $weapons)
    {
        $this->name = $name;
        $this->length = $length;
        $this->width = $width;
        $this->hp = $hp;
        $this->gas = $gas;
        $this->shield = $shield;
        $this->weapons = $weapons;
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

class weapon
{
    public string $name;
    public int $firepower;
    public int $attackDamage;
    public int $range;
    public int $ammo;
    public int $cooldown;

    public function __construct(string $name, int $firepower, int $attackDamage, int $range, int $ammo, int $cooldown)
    {
        $this->name = $name;
        $this->firepower = $firepower;
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

class engine
{
    public string $name;
    public int $speed;
    public int $accelaration;
    public string $type;

    public function __construct(string $name, int $speed, int $accelaration, string $type)
    {
        $this->name = $name;
        $this->speed = $speed;
        $this->accelaration = $accelaration;
        $this->$type = $type;
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
    public function getType(): string
    {
        return $this->type;
    }
}