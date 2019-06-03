<?php declare(strict_types=1);

namespace App\Tests\Market;

use App\Market\Checkout;
use App\Market\Entity\Product;
use App\Market\Exception\ProductNotFoundException;
use App\Market\Service\Price\PriceCalculator;
use App\Market\Service\ProductLoader;
use App\Market\Service\Stockable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    /** @var Stockable|MockObject */
    private $itemStack;

    /** @var ProductLoader|MockObject */
    private $productLoader;

    /** @var PriceCalculator|MockObject */
    private $priceCalculator;

    protected function setUp(): void
    {
        $this->itemStack = $this->createMock(Stockable::class);
        $this->productLoader = $this->createMock(ProductLoader::class);
        $this->priceCalculator = $this->createMock(PriceCalculator::class);
    }

    public function testWhenGivenSkuIsNotFoundThenThrowError(): void
    {
        $checkout = new Checkout($this->itemStack, $this->productLoader, $this->priceCalculator);

        $this->expectException(ProductNotFoundException::class);

        $checkout->scan('A');
    }

    public function testWhenGivenSkuFoundThenAddIntoStack(): void
    {
        $checkout = new Checkout($this->itemStack, $this->productLoader, $this->priceCalculator);
        $this->productLoader->method('loadBySku')->willReturn(new Product('A', 50));

        $this->itemStack->expects($this->once())->method('add');

        $checkout->scan('A');
    }
}
