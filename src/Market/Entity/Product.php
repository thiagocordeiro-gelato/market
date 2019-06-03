<?php declare(strict_types=1);

namespace App\Market\Entity;

class Product
{
    /** @var string */
    private $sku;

    /** @var float */
    private $price;

    public function __construct(string $sku, float $price)
    {
        $this->sku = $sku;
        $this->price = $price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
