<?php declare(strict_types=1);

namespace App\Controller;

use App\Market\Checkout;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Throwable;

class ScanController
{
    /** @var Checkout */
    private $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $skus = explode(',', $request->get('skus'));
        } catch (Throwable $e) {
            throw new BadRequestHttpException();
        }

        foreach ($skus as $sku) {
            $this->checkout->scan($sku);
        }

        return new JsonResponse([
            'total' => $this->checkout->total(),
        ]);
    }
}
