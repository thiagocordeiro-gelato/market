<?php declare(strict_types=1);

namespace App\Market\Entity;

interface Stocky
{
    public function getSku(): string;

    public function getPrice(): float;
}
