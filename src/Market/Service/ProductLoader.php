<?php declare(strict_types=1);

namespace App\Market\Service;

use App\Market\Entity\Product;

interface ProductLoader
{
    public function loadBySku(string $sku): ?Product;

    /**
     * @return Product[]
     */
    public function loadAll(): array;
}
