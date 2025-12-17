<?php

namespace Interfaces;

interface Iengine
{
    public function getName(): string;
    public function getSpeed(): int;
    public function getAccelaration(): int;
}
