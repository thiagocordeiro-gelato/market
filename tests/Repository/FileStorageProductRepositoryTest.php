<?php declare(strict_types=1);

namespace App\Tests\Repository;

use App\Market\Entity\Product;
use App\Repository\FileStorageProductRepository;
use PHPUnit\Framework\TestCase;

class FileStorageProductRepositoryTest extends TestCase
{
    /** @var FileStorageProductRepository */
    private $repository;

    protected function setUp(): void
    {
        $this->repository = new FileStorageProductRepository();
    }

    public function testWhenProductExistsWithGivenSkuThenReturnProduct(): void
    {
        $product = $this->repository->loadBySku('A');

        $this->assertInstanceOf(Product::class, $product);
    }

    public function testWhenProductDoesNotExistWithGivenSkuThenReturnProduct(): void
    {
        $product = $this->repository->loadBySku('M');

        $this->assertNull($product);
    }

    public function testLoadAllProduct(): void
    {
        $product = $this->repository->loadAll();

        $this->assertCount(4, $product);
    }
}
