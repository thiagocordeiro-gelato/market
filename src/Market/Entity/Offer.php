<?php declare(strict_types=1);

namespace App\Market\Entity;

class Offer
{
    /** @var string */
    private $sku;

    /** @var int */
    private $quantity;

    /** @var float */
    private $price;

    public function __construct(string $sku, int $quantity, float $price)
    {
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
