<?php
//declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;
use DOMDocument;
use DOMXPath;

class HtmlParser
{
    private const NEW_PRODUCTS_REG_EXP = '/(>\d минут((ы )|( )|(у ))назад<)/';
    private const ALL_PRODUCTS_XPATH_EXP = '//div[@data-marker="item"]';
    private const LINKS_XPATH_EXP = '//a[@data-marker="item-title"]';

    public function __construct(private LogService $logService)
    {
    }
    public function getProductsFromPage(string $html): array
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // подавить ошибки некорректного html
        $dom->loadHTML($html);

        $xpath = new DOMXPath($dom);

        $allProductNodes= $xpath->query(Self::ALL_PRODUCTS_XPATH_EXP);

        $allProductDives = [];
        foreach ($allProductNodes as $productNode) {
            $allProductDives[] = $dom->saveHTML($productNode);
        }
        $this->logService->info('!!!!!!'.json_encode($allProductDives));
        $newProductDives= array_filter($allProductDives, function ($html) {
            return preg_match(Self::NEW_PRODUCTS_REG_EXP, $html);
        });

        $newProductDives = array_values($newProductDives); // сбросить ключи



        $productsArray = [];

        foreach ($newProductDives as $div) {
            $doc = new DOMDocument();
            @$doc->loadHTML($div);

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
