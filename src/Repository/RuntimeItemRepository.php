<?php declare(strict_types=1);

namespace App\Repository;

use App\Market\Entity\Product;
use App\Market\Service\Stockable;

class RuntimeItemRepository implements Stockable
{
    /** @var Product[] */
    private $items = [];

    public function add(Product $item): void
    {
        $this->items[$item->getSku()] = $item;
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->items;
    }
}
