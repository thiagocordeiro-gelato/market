<?php declare(strict_types=1);

namespace App\Tests\Market\ValueObject;

use App\Market\ValueObject\ProductSummary;
use PHPUnit\Framework\TestCase;

class ProductSummaryTest extends TestCase
{
    public function testPriceShouldBeUnitPriceMultipliedByAmount(): void
    {
        $summary = new ProductSummary('A', 50, 6);

        $this->assertEquals(300, $summary->getPrice());
    }
}
