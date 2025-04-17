<?php
declare(strict_types=1);

namespace App\DataBaseManagers;

use App\Models\Product;

class ProductManager
{
    public function __construct(
        private Product $productModel
    )
    {
    }

    public function save(array $productsArray): int
    {
        $this->validateInput($productsArray);

        $preparedData = $this->prepareData($productsArray);

        try {
            $this->productModel->newQuery()->insert($preparedData);
            return count($preparedData);
        } catch (\Exception $e) {
            throw new \RuntimeException(
                'Product insertion error: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    private function validateInput(array $productsArray): void
    {
        foreach ($productsArray as $product) {
            if (!isset($product['title'], $product['uri'])) {
                throw new \InvalidArgumentException(
                    'Product data must contain title and uri fields'
                );
            }
        }
    }

    private function prepareData(array $productsArray): array
    {
        return array_map(function ($product) {
            return [
                'title' => $product['title'],
                'city' => $product['city'] ?? null,
                'uri' => $product['uri'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $productsArray);
    }

}
