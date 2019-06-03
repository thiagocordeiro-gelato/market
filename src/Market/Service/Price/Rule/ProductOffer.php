<?php declare(strict_types=1);

namespace App\Market\Service\Price\Rule;

use App\Market\Service\OfferLoader;
use App\Market\Service\Price\Rule;
use App\Market\ValueObject\MappedProducts;

class ProductOffer implements Rule
{
    /** @var OfferLoader */
    private $offerLoader;

    public function __construct(OfferLoader $offerLoader)
    {
        $this->offerLoader = $offerLoader;
    }

    /**
     * @inheritDoc
     */
    public function getDifference(MappedProducts $mapped): float
    {
        $discount = 0;

        foreach ($mapped->getSummaries() as $summary) {
            $offer = $this->offerLoader->loadBySkuAndAmount($summary->getSku());

            if ($offer->getAmount() > $summary->getAmount()) {
                continue;
            }

            $multiplier = floor($summary->getAmount() / $offer->getAmount());
            $difference = $summary->getPrice() - $offer->getPrice();

            $discount += $multiplier * $difference;
        }

        return -$discount;
    }
}
