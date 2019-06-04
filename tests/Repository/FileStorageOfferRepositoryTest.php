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
    public function testLoadBySkuAndQuantity(string $sku, bool $found): void
    {
        $offer = $this->repository->loadBySkuAndAmount($sku);

        $isOffer = $offer instanceof Offer;

        $this->assertEquals($found, $isOffer);
    }

    public function loadBySkuAndQuantityDataset(): array
    {
        return [
            'Should find rule for A' => ['sku' => 'A', 'found' => true],
            'Should find rule for B' => ['sku' => 'B', 'found' => true],
            'Should not find rule for C' => ['sku' => 'C', 'found' => false],
            'Should not find rule for D' => ['sku' => 'D', 'found' => false],
        ];
    }
}
