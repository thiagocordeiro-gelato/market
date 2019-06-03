<?php declare(strict_types=1);

namespace App\Market\Service\Price;

use App\Market\ValueObject\MappedProducts;

interface Rule
{
    /**
     * @param MappedProducts $mapped
     */
    public function getDifference(MappedProducts $mapped): float;
}
