<?php declare(strict_types=1);

namespace App\Market\Service;

use App\Market\Entity\Stocky;

interface Stockable
{
    public function add(Stocky $item): void;

    /**
     * @return Stocky[]
     */
    public function getAll(): array;
}
