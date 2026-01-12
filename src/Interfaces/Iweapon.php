<?php

namespace Interfaces;

interface Iweapon
{

    public function getName(): string;
    public function getFirepower(): int;
    public function getHitChance(): int;
    public function getAttackDamage(): int;
    public function getRange(): int;
    public function getAmmo(): int;
    public function getCooldown(): int;
}
