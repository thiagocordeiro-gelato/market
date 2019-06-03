<?php declare(strict_types=1);

namespace App\Market\Service\Price;

use App\Market\Entity\Product;
use App\Market\ValueObject\MappedProducts;

class PriceCalculator
{
    /** @var Rule[] */
    private $rules = [];

    public function __construct(array $rules)
    {
        array_map(function (Rule $rule) {
            $this->rules[] = $rule;
        }, $rules);
    }

    /**
     * @param Product[] $products
     */
    public function calculate(array $products): float
    {
        $mapped = MappedProducts::create($products);
        $total = $mapped->getTotal();

        foreach ($this->rules as $rule) {
            $total += $rule->getDifference($mapped);
        }

        return $total;
    }
}
