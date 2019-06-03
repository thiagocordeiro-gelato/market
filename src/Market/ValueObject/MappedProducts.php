<?php declare(strict_types=1);

namespace App\Market\ValueObject;

use App\Market\Entity\Product;

class MappedProducts
{
    /** @var float */
    private $total;

    /** @var ProductSummary[] */
    private $summaries;

    private function __construct(float $total, array $summaries)
    {
        $this->total = $total;
        $this->summaries = $summaries;
    }

    /**
     * @param Product[] $products
     */
    public static function create(array $products): self
    {
        $total = 0;
        $summaries = [];

        foreach ($products as $product) {
            $sku = $product->getSku();
            $total += $product->getPrice();

            $summary = $summaries[$sku] ?? null;

            if (!$summary instanceof ProductSummary) {
                $summary = new ProductSummary($product->getSku(), $product->getPrice());
            }

            $summary->increment();

            $summaries[$sku] = $summary;
        }

        return new self($total, $summaries);
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return ProductSummary[]
     */
    public function getSummaries(): array
    {
        return $this->summaries;
    }
}
