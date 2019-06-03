<?php declare(strict_types=1);

namespace App\Tests\Market;

use App\Market\Checkout;
use App\Market\Entity\Product;
use App\Market\Exception\ProductNotFoundException;
use App\Market\Service\ItemStack;
use App\Market\Service\ProductLoader;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{
    /** @var ItemStack|MockObject */
    private $itemStack;

    /** @var ProductLoader|MockObject */
    private $productLoader;

    protected function setUp(): void
    {
        $this->itemStack = $this->createMock(ItemStack::class);
        $this->productLoader = $this->createMock(ProductLoader::class);
    }

    public function testWhenGivenSkuIsNotFoundThenThrowError(): void
    {
        $checkout = new Checkout($this->itemStack, $this->productLoader);

        $this->expectException(ProductNotFoundException::class);

        $checkout->scan('A');
    }

    public function testWhenGivenSkuFoundThenAddIntoStack(): void
    {
        $checkout = new Checkout($this->itemStack, $this->productLoader);
        $this->productLoader->method('loadBySku')->willReturn(new Product('A', 50));

        $this->itemStack->expects($this->once())->method('add');

        $checkout->scan('A');
    }

    public function testWhenItemsAreAddedThenGetTotal(): void
    {
        $product = new Product('C', 20);
        $checkout = new Checkout($this->itemStack, $this->productLoader);
        $this->productLoader->method('loadBySku')->willReturn($product);
        $this->itemStack->method('getAll')->willReturn([$product, $product, $product]);

        $total = $checkout->total();

        $this->assertEquals(60, $total);
    }
}
