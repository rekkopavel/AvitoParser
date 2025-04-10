<?php

declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;
use DOMDocument;
use DOMXPath;
use DOMNodeList;

class HtmlParser
{
    private const NEW_PRODUCTS_REG_EXP = '/(>\d минут(ы|у)? назад<|>2 часа назад<|>1 час<|>Вчера<)/';
    private const ALL_PRODUCTS_XPATH = '//div[@data-marker="item"]';
    private const ITEM_TITLE_XPATH = '//a[@data-marker="item-title"]';
    private const AVITO_BASE_URL = 'https://www.avito.ru/';

    public function __construct(
        private LogService $logService
    )
    {
    }

    public function getProductsFromPage(string $html): array
    {
        $products = $this->parseAllProducts($html);
        $newProducts = $this->filterNewProducts($products);

        return $this->extractProductsData($newProducts);
    }

    private function parseAllProducts(string $html): array
    {
        $doc = $this->createDomDocument($html);
        $xpath = new DOMXPath($doc);

        $productNodes = $xpath->query(self::ALL_PRODUCTS_XPATH);

        return $this->convertNodesToHtmlArray($productNodes, $doc);
    }

    private function filterNewProducts(array $products): array
    {
        return array_values(array_filter(
            $products,
            fn($html) => preg_match(self::NEW_PRODUCTS_REG_EXP, $html)
        ));
    }

    private function extractProductsData(array $productsHtml): array
    {
        $result = [];

        foreach ($productsHtml as $html) {
            $productData = $this->extractProductData($html);
            if ($productData) {
                $result[] = $productData;
            }
        }

        return $result;
    }

    private function extractProductData(string $html): ?array
    {
        $doc = $this->createDomDocument($html);
        $xpath = new DOMXPath($doc);

        $linkNode = $xpath->query(self::ITEM_TITLE_XPATH)->item(0);

        if (!$linkNode) {
            $this->logService->warning('Product title link not found', ['html' => $html]);
            return null;
        }

        return [
            'uri' => self::AVITO_BASE_URL . $linkNode->getAttribute('href'),
            'title' => $linkNode->getAttribute('title'),
        ];
    }

    private function createDomDocument(string $html): DOMDocument
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        return $doc;
    }

    private function convertNodesToHtmlArray(DOMNodeList $nodes, DOMDocument $doc): array
    {
        $result = [];
        foreach ($nodes as $node) {
            $result[] = $doc->saveHTML($node);
        }
        return $result;
    }
}
