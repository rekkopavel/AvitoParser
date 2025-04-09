<?php
//declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;

class HtmlParser
{

    private const QUANTITY_NEW_PRODUCTS_REG_EXP = '/(>\d минут((ы )|( )|(у ))назад<)/';
    private const LINK_NEW_PRODUCT_REG_EXP = '/<a\s[^>]*data-marker="item-title"[^>]*title="([^"]*)"[^>]*href="([^"]*)"[^>]*>/';
    public function __construct(private LogService $logService)
    {
    }
    public function getAllProductLinks(string $html): array
    {
        $quantityProducts = preg_match_all(Self::QUANTITY_NEW_PRODUCTS_REG_EXP, $html, $matches, PREG_PATTERN_ORDER);
       // $this->logService->info('!!!!!!'.$quantityProducts);
        if ($quantityProducts === false|| 0) {
            return [];
        }
        $quantityLinks = preg_match_all(Self::LINK_NEW_PRODUCT_REG_EXP, $html, $matches, PREG_SET_ORDER);
        $this->logService->info('!!!!!!'.json_encode($matches));

        if ($quantityLinks === false|| 0) {
            return [];
        }
        $links = array_map(function ($match) {
            return [
                'city' => 'test',
                'title' => trim($match['title']),
                'uri' => trim($match['uri'])
            ];
        }, $matches);

        return $links;
    }

}
