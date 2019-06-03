<?php declare(strict_types=1);

namespace App\Market\Entity;

class Item
{
    /** @var Product */
    private $product;

    /** @var int */
    private $amount;

    public function __construct(Product $product, int $amount)
    {
        $this->product = $product;
        $this->amount = $amount;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
