<?php

namespace App\DataBaseManagers;

use App\Models\Product;

class ProductManager
{
    public function save(array $links): int
    {
        $savedCount = 0;

        foreach ($links as $link) {


            try {
                Product::create([
                    'title' => $link['title'],
                    'city' => $link['city'] ?? null,
                    'uri' => $link['uri'],

                ]);

                $savedCount++;
            } catch (\Exception $e) {
                // Пропускаем ошибки (дубликаты и пр.)
                continue;
            }
        }

        return $savedCount;
    }

}
