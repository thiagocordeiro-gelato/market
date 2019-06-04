<?php declare(strict_types=1);

namespace App\Market\ValueObject;

class ProductSummary
{
    /** @var string */
    private $sku;

    /** @var float */
    private $unitPrice;

    /** @var int */
    private $amount = 0;

    public function __construct(string $sku, float $unitPrice, int $amount = 0)
    {
        $this->sku = $sku;
        $this->unitPrice = $unitPrice;
        $this->amount = $amount;
    }

    public function increment(): void
    {
        $this->amount++;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getPrice(): float
    {
        return $this->unitPrice * $this->amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
