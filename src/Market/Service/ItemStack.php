<?php declare(strict_types=1);

namespace App\Market\Service;

use App\Market\Entity\Stocky;

class ItemStack
{
    /** @var Stockable */
    private $stock;

    public function __construct(Stockable $stock)
    {
        $this->stock = $stock;
    }

    public function add(Stocky $item): void
    {
        $this->stock->add($item);
    }

    /**
     * @return Stocky[]
     */
    public function getAll(): array
    {
        return $this->stock->getAll();
    }
}
