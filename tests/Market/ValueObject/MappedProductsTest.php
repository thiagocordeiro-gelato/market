<?php declare(strict_types=1);

namespace App\Tests\Market\ValueObject;

use App\Market\Entity\Product;
use App\Market\ValueObject\MappedProducts;
use App\Market\ValueObject\ProductSummary;
use PHPUnit\Framework\TestCase;

class MappedProductsTest extends TestCase
{
    /** @var MappedProducts */
    private $mapped;

    protected function setUp(): void
    {
        $this->mapped = MappedProducts::create([
            new Product('A', 50),
            new Product('A', 50),
            new Product('A', 50),
            new Product('B', 30),
            new Product('C', 10),
        ]);
    }

    public function testShouldMapProductIntoSummaries(): void
    {
        $expected = [
            'A' => new ProductSummary('A', 50, 3),
            'B' => new ProductSummary('B', 30, 1),
            'C' => new ProductSummary('C', 10, 1),
        ];

        $this->assertEquals($expected, $this->mapped->getSummaries());
    }

    public function testShouldSumTotal(): void
    {
        $this->assertEquals(190, $this->mapped->getTotal());
    }
}
