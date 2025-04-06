<?php
declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

class HtmlParser
{
    private const QUANTITY_NEW_PRODUCTS_REG_EXP = '/(>\d минут((ы )|( )|(у ))назад<)/';
    private const LINK_NEW_PRODUCT_REG_EXP = ' <div class="product-item">.*?
    <a href="(?<uri>[^"]+)".*?>
    <span class="city">(?<city>[^<]+)<\/span>.*?
    <h3>(?<title>[^<]+)<\/h3>.*?
    <\/a>.*?
    <\/div>
/sxu';

    public function getAllProductLinks(string $html): array
    {
        $quantityProducts = preg_match_all(Self::QUANTITY_NEW_PRODUCTS_REG_EXP, $html, $matches, PREG_PATTERN_ORDER);

        if ($quantityProducts === false) {
            return [];
        }
        preg_match_all(Self::LINK_NEW_PRODUCT_REG_EXP, $html, $matches, PREG_SET_ORDER);

        if ($matches === false) {
            throw new \RuntimeException('Regex error');
        }
        $links = array_map(function ($match) {
            return [
                'city' => trim($match['city']),
                'title' => trim($match['title']),
                'uri' => trim($match['uri'])
            ];
        }, $matches);

        return $links;
    }

}
