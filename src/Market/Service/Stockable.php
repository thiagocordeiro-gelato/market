<?php declare(strict_types=1);

namespace App\Market\Service;

use App\Market\Entity\Product;

interface Stockable
{
    public function add(Product $item): void;

    /**
     * @return Product[]
     */
    public function getAll(): array;
}
