<?php declare(strict_types=1);

namespace App\Repository;

use App\Market\Entity\Stocky;
use App\Market\Service\Stockable;

class RuntimeItemRepository implements Stockable
{
    /** @var Stocky[] */
    private $items = [];

    public function add(Stocky $item): void
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
