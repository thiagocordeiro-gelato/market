<?php declare(strict_types=1);

namespace App\Tests\Market\Service;

use App\Market\Entity\Product;
use App\Market\Service\Price\PriceCalculator;
use App\Market\Service\Price\Rule\TenPercentDiscount;
use App\Tests\Fixtures\Market\Service\Rule\Discount;
use App\Tests\Fixtures\Market\Service\Rule\Sum;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    public function testWhenProvidedNoRulesThenReturnTotalWithoutChanging(): void
    {
        $calculator = new PriceCalculator([]);

        $total = $calculator->calculate([new Product('A', 50), new Product('B', 30), new Product('C', 20)]);

        $this->assertEquals(100, $total);
    }

    public function testWhenProvidedSingleRuleThenDiscountValueFromTotal(): void
    {
        $calculator = new PriceCalculator([new TenPercentDiscount()]);

        $total = $calculator->calculate([
            new Product('A', 50),
            new Product('A', 50),
            new Product('A', 50),
            new Product('A', 50),
            new Product('B', 30),
            new Product('B', 30),
            new Product('B', 30),
            new Product('C', 20),
            new Product('C', 20),
        ]);

        $this->assertEquals(297.0, $total);
    }

    public function testWhenProvidedMultipleRulesThenDiscountValueFromTotal(): void
    {
        $calculator = new PriceCalculator([
            new TenPercentDiscount(),
            new Sum(500),
            new Discount(150),
        ]);

        $total = $calculator->calculate([
            new Product('A', 50),
            new Product('A', 50),
            new Product('A', 50),
            new Product('A', 50),
            new Product('B', 30),
            new Product('B', 30),
            new Product('B', 30),
            new Product('C', 20),
            new Product('C', 20),
        ]);

        $this->assertEquals(647.0, $total);
    }
}
