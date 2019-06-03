<?php declare(strict_types=1);

namespace App\Repository;

use App\Market\Entity\Offer;
use App\Market\Service\OfferLoader;
use Exception;

class FileStorageOfferRepository implements OfferLoader
{
    private $data = [];

    public function __construct()
    {
        $content = file_get_contents(__DIR__.'/../../storage/offers.json');

        if (!$content) {
            throw new Exception('Unable to load offers');
        }

        $this->data = json_decode($content, true);
    }

    public function loadBySkuAndAmount(string $sku, int $amount): ?Offer
    {
        $data = $this->data[$sku] ?? null;

        if (!$data) {
            return null;
        }

        $offer = new Offer($data['sku'], $data['amount'], $data['price']);

        if ($offer->getAmount() != $amount) {
            return null;
        }

        return $offer;
    }
}
