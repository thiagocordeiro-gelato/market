<?php declare(strict_types=1);

namespace App\Repository;

use App\Market\Entity\Product;
use App\Market\Service\ProductLoader;
use Exception;

class FileStorageProductRepository implements ProductLoader
{
    private $data = [];

    public function __construct()
    {
        $content = file_get_contents(__DIR__.'/../../storage/products.json');

        if (!$content) {
            throw new Exception('Unable to load products');
        }

        $this->data = json_decode($content, true);
    }

    public function loadBySku(string $sku): ?Product
    {
        $data = $this->data[$sku] ?? null;

        if (!$data) {
            return null;
        }

        return new Product($data['sku'], $data['price']);
    }
}
