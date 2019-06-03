<?php declare(strict_types=1);

namespace App\Market\Service\Price\Rule;

use App\Market\Service\Price\Rule;
use App\Market\ValueObject\MappedProducts;

class TenPercentDiscount implements Rule
{
    /**
     * @inheritDoc
     */
    public function getDifference(MappedProducts $mapped): float
    {
        if ($mapped->getTotal() < 200) {
            return 0;
        }

        $discount = (($mapped->getTotal() / 100) * 10);

        return -round($discount, 2);
    }
}
