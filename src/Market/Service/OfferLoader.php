<?php declare(strict_types=1);

namespace App\Market\Service;

use App\Market\Entity\Offer;

interface OfferLoader
{
    public function loadBySkuAndQuantity(string $sku, int $quantity): ?Offer;
}
