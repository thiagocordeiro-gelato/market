<?php declare(strict_types=1);

namespace App\Market\Exception;

use Exception;

class ProductNotFoundException extends Exception
{
    /** @var string */
    private $sku;

    public function __construct(string $sku)
    {
        $this->sku = $sku;

        parent::__construct();
    }
}
