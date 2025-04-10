<?php
//declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;
use DOMDocument;
use DOMXPath;

class HtmlParser
{
    private const NEW_PRODUCTS_REG_EXP = '/(>\d минут(ы|у)? назад<|>2 часа назад<|>1 час<|>Вчера<)/';
    private const ALL_PRODUCTS_XPATH_EXP = '//div[@data-marker="item"]';
    private const LINK_AND_TITLE_XPATH_EXP = '//a[@data-marker="item-title"]';
    private const AVITO_BASE_URL = 'https://www.avito.ru/';


    public function __construct(private LogService $logService)
    {
    }
    public function getProductsFromPage(string $html): array
    {

        $doc = new DOMDocument('1.0', 'UTF-8');
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($doc);

        $allProductNodes= $xpath->query(Self::ALL_PRODUCTS_XPATH_EXP);

        $allProductDivs = [];
        foreach ($allProductNodes as $productNode) {
            $allProductDivs[] = $doc->saveHTML($productNode);
        }


        $newProductDivs= array_filter($allProductDivs, function ($html) {
            $res =  preg_match(Self::NEW_PRODUCTS_REG_EXP, $html);
            return $res;
        });

        $newProductDivs = array_values($newProductDivs); // сбросить ключи


        $productsArray = [];
        foreach ($newProductDivs as $div) {
            $doc = new DOMDocument('1.0', 'UTF-8');
            @$doc->loadHTML(mb_convert_encoding($div, 'HTML-ENTITIES', 'UTF-8'));
            $xpath = new DOMXPath($doc);

            $linkNode = $xpath->query(Self::LINK_AND_TITLE_XPATH_EXP)->item(0);

            if ($linkNode) {
                $url = $linkNode->getAttribute('href');
                $title = $linkNode->getAttribute('title');

                $productsArray[] = [
                    'uri' => Self::AVITO_BASE_URL.$url,
                    'title' => $title,
                ];
            }
        }

        return $productsArray;
    }

}
