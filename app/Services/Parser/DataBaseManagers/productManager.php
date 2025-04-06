<?php

namespace App\Services\Parser\DataBaseManagers;

use App\Models\Porduct;

class productManager
{
    public function save(array $links): int
    {
        $savedCount = 0;

        foreach ($links as $link) {


            try {
                Porduct::create([
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
