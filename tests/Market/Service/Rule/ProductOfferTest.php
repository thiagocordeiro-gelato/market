<?php declare(strict_types=1);

namespace App\Tests\Market\Service\Rule;

use App\Market\Entity\Offer;
use App\Market\Entity\Product;
use App\Market\Service\OfferLoader;
use App\Market\Service\Price\Rule\ProductOffer;
use App\Market\ValueObject\MappedProducts;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ProductOfferTest extends TestCase
{
    /** @var OfferLoader|MockObject */
    private $offerLoader;

    protected function setUp(): void
    {
        $this->offerLoader = $this->createMock(OfferLoader::class);
    }

    public function testWhenProductMatchOfferThenApplyDiscount(): void
    {
        $this->offerLoader->method('loadBySkuAndAmount')->willReturn(new Offer('A', 3, 130));
        $rule = new ProductOffer($this->offerLoader);
        $mapped = MappedProducts::create([
            new Product('A', 50),
            new Product('A', 50),
            new Product('A', 50),
            new Product('B', 20),
            new Product('C', 10),
        ]);

        $discount = $rule->getDifference($mapped);

        $this->assertEquals(-20, $discount);
    }
}
