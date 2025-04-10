<?php
//declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;
use DOMDocument;
use DOMXPath;

class HtmlParser
{
    private const NEW_PRODUCTS_REG_EXP = '/(>\d минут(ы|у)? назад<|>2 часа назад<)/';
    private const ALL_PRODUCTS_XPATH_EXP = '//div[@data-marker="item"]';
    private const LINKS_XPATH_EXP = '//a[@data-marker="item-title"]';
    private const DIV_TIME_WRAPPER_XPATH_EXP = '//div[@data-marker="item-date/wrapper"]';

    public function __construct(private LogService $logService)
    {
    }
    public function getProductsFromPage(string $html): array
    {
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
        //$this->logService->info('!!!!!! - '.$html.'\n');
        $dom = new DOMDocument('1.0', 'UTF-8');
        @$dom->loadHTML($html);

        $xpath = new DOMXPath($dom);

        $allProductNodes= $xpath->query(Self::ALL_PRODUCTS_XPATH_EXP);

        $allProductDivs = [];
        foreach ($allProductNodes as $productNode) {
            $allProductDivs[] = $dom->saveHTML($productNode);
        }
        $allProductDivs = [$allProductDivs[0]];
/*
        $this->logService->info('!!!!!!  $allProductDivs - '.print_r($allProductDivs,true).'\n');
        $allTimeDivs = [];

        foreach ($allProductDivs as $productDiv){
            $doc = new DOMDocument('1.0', 'UTF-8');
            @$doc->loadHTML( mb_convert_encoding($productDiv, 'HTML-ENTITIES', 'UTF-8'));

            $xpath = new DOMXPath($doc);
            $timeDivNode = $xpath->query(Self::DIV_TIME_WRAPPER_XPATH_EXP)->item(0);


            $timeDiv = $timeDivNode->C14N(); // Получаем HTML содержимое узла
            $allTimeDivs[] = $timeDiv;

        }
        $this->logService->info('!!!!!! $allTimeDivs - '.print_r($allTimeDivs,true).'\n');

         //$this->logService->info('TIME DIV ---- '.json_encode($allTimeDivs[1]));
        //$allProductDivs = [$allProductDivs[1]];
        //$this->logService->info('!!!!!!'.count($allProductDivs));
       // $this->logService->info('!!!!!!'.json_encode($allProductDivs));

*/
        $newProductDivs= array_filter($allProductDivs, function ($html) {
            $res =  preg_match(Self::NEW_PRODUCTS_REG_EXP, $html);
            $this->logService->info('ppppp'.$res);
            return $res;
        });

        $newProductDivs = array_values($newProductDivs); // сбросить ключи

        $this->logService->info('!!!!!! $newProductDivs  - '.print_r($newProductDivs,true).'\n');

        $productsArray = [];

        foreach ($newProductDivs as $div) {
            $doc = new DOMDocument('1.0', 'UTF-8');
            @$doc->loadHTML(mb_convert_encoding($div, 'HTML-ENTITIES', 'UTF-8'));

            $xpath = new DOMXPath($doc);
            $linkNode = $xpath->query(Self::LINKS_XPATH_EXP)->item(0);

            if ($linkNode) {
                $url = $linkNode->getAttribute('href');
                $title = $linkNode->getAttribute('title');

                $productsArray[] = [
                    'url' => $url,
                    'title' => $title,
                ];
            }
        }

        return $productsArray;
    }

}
