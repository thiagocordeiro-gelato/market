<?php declare(strict_types=1);

namespace App\Market;

use App\Market\Exception\ProductNotFoundException;
use App\Market\Service\Price\PriceCalculator;
use App\Market\Service\ProductLoader;
use App\Market\Service\Stockable;

class Checkout
{
    /** @var Stockable */
    private $itemStack;

    /** @var ProductLoader */
    private $productLoader;

    /** @var PriceCalculator */
    private $calculator;

    public function __construct(Stockable $itemStack, ProductLoader $productLoader, PriceCalculator $calculator)
    {
        $this->itemStack = $itemStack;
        $this->productLoader = $productLoader;
        $this->calculator = $calculator;
    }

    public function scan(string $sku): void
    {
        $product = $this->productLoader->loadBySku($sku);

        if (!$product) {
            throw new ProductNotFoundException($sku);
        }

        $this->itemStack->add($product);
    }

    public function total(): float
    {
        $products = $this->itemStack->getAll();

        return $this->calculator->calculate($products);
    }
}
