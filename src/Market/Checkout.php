<?php declare(strict_types=1);

namespace App\Market;

use App\Market\Exception\ProductNotFoundException;
use App\Market\Service\ProductLoader;
use App\Market\Service\Stockable;

class Checkout
{
    /** @var Stockable */
    private $itemStack;

    /** @var ProductLoader */
    private $productLoader;

    public function __construct(Stockable $itemStack, ProductLoader $productLoader)
    {
        $this->itemStack = $itemStack;
        $this->productLoader = $productLoader;
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
        $items = $this->itemStack->getAll();
        $total = 0;

        foreach ($items as $item) {
            $total += $item->getPrice();
        }

        return $total;
    }
}
