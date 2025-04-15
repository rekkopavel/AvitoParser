<?php
declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;
use DOMDocument;
use DOMXPath;

class HtmlParser
{
    private const NEW_PRODUCTS_REG_EXP = '/(>\d минут(ы|у)? назад<|>2 часа назад<|>1 час<|>Вчера<)/';
    private const ALL_PRODUCTS_XPATH = '//div[@data-marker="item"]';
    private const LINK_AND_TITLE_XPATH = '//a[@data-marker="item-title"]';
    private const AVITO_BASE_URL = 'https://www.avito.ru/';


    public function getProductsFromPage(string $html): array
    {

        $allProductDivs = $this->parseAllProducts($html);
        $newProductsDivs = $this->filterNewProducts($allProductDivs);

        return $this->extractProductsDataArray($newProductsDivs);


    }

    private function extractProductsDataArray(array $productsDivs): array
    {
        $productsDataArray = [];
        foreach ($productsDivs as $div) {
            $doc = $this->createDomDocument($div);
            $xpath = new DOMXPath($doc);


            $linkNode = $xpath->query(Self::LINK_AND_TITLE_XPATH)->item(0);

            if ($linkNode) {
                $url = $linkNode->getAttribute('href');
                $title = $linkNode->getAttribute('title');

                $productsDataArray[] = [
                    'uri' => Self::AVITO_BASE_URL . $url,
                    'title' => $title,
                ];
            }
        }
        return $productsDataArray;
    }

    private function filterNewProducts(array $allProductDivs): array
    {
        return array_values(array_filter(
            $allProductDivs,
            fn($html) => preg_match(self::NEW_PRODUCTS_REG_EXP, $html)
        ));
    }

    private function parseAllProducts(string $html): array
    {
        $doc = $this->createDomDocument($html);
        $xpath = new DOMXPath($doc);

        $allProductNodes = $xpath->query(self::ALL_PRODUCTS_XPATH);

        $allProductDivs = [];
        foreach ($allProductNodes as $productNode) {
            $allProductDivs[] = $doc->saveHTML($productNode);
        }
        return $allProductDivs;
    }

    private function createDomDocument(string $html): DOMDocument
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        return $doc;
    }
}
