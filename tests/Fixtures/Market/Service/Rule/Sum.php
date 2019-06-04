<?php declare(strict_types=1);

namespace App\Tests\Fixtures\Market\Service\Rule;

use App\Market\Service\Price\Rule;
use App\Market\ValueObject\MappedProducts;

class Sum implements Rule
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = abs($value);
    }

    /**
     * @param MappedProducts $mapped
     */
    public function getDifference(MappedProducts $mapped, float $total): float
    {
        return $this->value;
    }
}
