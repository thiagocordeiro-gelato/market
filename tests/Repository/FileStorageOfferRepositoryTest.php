<?php declare(strict_types=1);

namespace App\Tests\Repository;

use App\Market\Entity\Offer;
use App\Repository\FileStorageOfferRepository;
use PHPUnit\Framework\TestCase;

class FileStorageOfferRepositoryTest extends TestCase
{
    /** @var FileStorageOfferRepository */
    private $repository;

    protected function setUp(): void
    {
        $this->repository = new FileStorageOfferRepository();
    }

    /**
     * @dataProvider loadBySkuAndQuantityDataset
     */
    public function testLoadBySkuAndQuantity(string $sku, int $quantity, bool $found): void
    {
        $offer = $this->repository->loadBySkuAndAmount($sku, $quantity);

        $isOffer = $offer instanceof Offer;

        $this->assertEquals($found, $isOffer);
    }

    public function loadBySkuAndQuantityDataset(): array
    {
        return [
            'do not find C with 1 itens' => ['sku' => 'C', 'quantity' => 1, 'found' => false],
            'do not find A with 1 itens' => ['sku' => 'A', 'quantity' => 1, 'found' => false],
            'find A with 3 itens' => ['sku' => 'A', 'quantity' => 3, 'found' => true],
            'find B with 2 itens' => ['sku' => 'B', 'quantity' => 2, 'found' => true],
            'do not find B with 4 itens' => ['sku' => 'B', 'quantity' => 4, 'found' => false],
        ];
    }
}
