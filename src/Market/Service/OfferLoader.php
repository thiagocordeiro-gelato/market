<?php declare(strict_types=1);

namespace App\Market\Service;

use App\Market\Entity\Offer;

interface OfferLoader
{
    public function loadBySkuAndAmount(string $sku): ?Offer;
}
