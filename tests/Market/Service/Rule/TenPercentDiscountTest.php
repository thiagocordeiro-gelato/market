<?php declare(strict_types=1);

namespace App\Tests\Market\Service\Rule;

use App\Market\Entity\Product;
use App\Market\Service\Price\Rule\TenPercentDiscount;
use App\Market\ValueObject\MappedProducts;
use PHPUnit\Framework\TestCase;

class TenPercentDiscountTest extends TestCase
{
    /**
     * @dataProvider discountDataset
     */
    public function testDiscount(float $price, float $expected): void
    {
        $rule = new TenPercentDiscount();

        $discount = $rule->getDifference(MappedProducts::create([new Product('A', $price)]));

        $this->assertEquals($expected, $discount);
    }

    public function discountDataset(): array
    {
        return [
            '$10 should not have discount' => ['price' => 10, 'expected' => 0],
            '$199,99 should not have discount' => ['price' => 199.99, 'expected' => 0],
            '$200 should have $20 discount' => ['price' => 200, 'expected' => -20],
            '$200.01 should have $20 discount' => ['price' => 200.01, 'expected' => -20],
            '$250 should have $25 discount' => ['price' => 250, 'expected' => -25],
        ];
    }
}
