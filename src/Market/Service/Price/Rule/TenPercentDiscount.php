<?php declare(strict_types=1);

namespace App\Market\Service\Price\Rule;

use App\Market\Service\Price\Rule;
use App\Market\ValueObject\MappedProducts;

class TenPercentDiscount implements Rule
{
    /**
     * @inheritDoc
     */
    public function getDifference(MappedProducts $mapped, float $total): float
    {
        if ($total < 200) {
            return 0;
        }

        $discount = (($total / 100) * 10);

        return -round($discount, 2);
    }
}
