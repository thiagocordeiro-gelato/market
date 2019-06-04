<?php declare(strict_types=1);

namespace App\Market\Entity;

class Offer
{
    /** @var string */
    private $sku;

    /** @var int */
    private $amount;

    /** @var float */
    private $price;

    public function __construct(string $sku, int $amount, float $price)
    {
        $this->sku = $sku;
        $this->amount = $amount;
        $this->price = $price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
