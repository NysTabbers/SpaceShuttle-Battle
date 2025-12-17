<?php

namespace Interfaces;

interface Ispaceship
{
    public function getName(): string;
    public function getLength(): int;
    public function getWidth(): int;
    public function getHP(): int;
    public function getGas(): int;
    public function getShield(): int;
    public function __setName(string $name): void;
}
