<?php
declare(strict_types=1);

namespace App\DataBaseManagers;

use App\Models\Product;
use App\Services\LogService;


class ProductManager
{
    public function __construct(
        private LogService $logService
    )
    {
    }

    public function save(array $productsArray): int
    {
        $savedCount = 0;

        foreach ($productsArray as $product) {


            Product::create([
                'title' => $product['title'],
                'city' => $product['city'] ?? null,
                'uri' => $product['uri'],

            ]);

            $savedCount++;

        }

        return $savedCount;
    }

}
