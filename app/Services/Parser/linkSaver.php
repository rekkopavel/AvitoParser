<?php

namespace App\Services\Parser;

use App\Models\Link;

class linkSaver
{
    public function saveLinksToBase(array $links):int
    {
        $savedCount = 0;

        foreach ($links as $link) {


            try {
                Link::create([
                    'uri' => $link['uri'],
                    'title' => $link['title'] ?? null,

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
