<?php declare(strict_types=1);

namespace App\Market\Entity;

class ProductOffer implements Stocky
{
    /** @var Offer */
    private $offer;

    /** @var Product[] */
    private $products;

    public function __construct(Offer $offer, array $products)
    {
        $this->offer = $offer;
        $this->products = $products;
    }

    public function getOffer(): Offer
    {
        return $this->offer;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getSku(): string
    {
        return $this->offer->getSku();
    }

    public function getPrice(): float
    {
        return $this->offer->getPrice();
    }
}
