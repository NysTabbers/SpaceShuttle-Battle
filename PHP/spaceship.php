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

    public function getInfo(): string
    {
        $info = "\n $this->length" . "\n $this->width" . "\n $this->hp" . "\n $this->gas" . "\n $this->shield";
        return $info;
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

    public function getInfo(): string
    {
        $info = "\n $this->firepower" . "\n $this->attackDamage" . "\n $this->ammo" . "\n $this->cooldown";
        return $info;
    }
}
