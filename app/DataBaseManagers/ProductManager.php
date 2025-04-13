<?php
declare(strict_types=1);

namespace App\DataBaseManagers;

use App\Models\Product;

readonly class ProductManager
{

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
