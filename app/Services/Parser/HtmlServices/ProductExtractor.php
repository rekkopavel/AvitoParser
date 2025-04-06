<?php

namespace App\Services\Parser\HtmlServices;


use App\Services\Parser\HtmlServices\HtmlFetcher;

class ProductExtractor
{
    public function __construct(private HtmlFetcher $htmlFetcher, private HtmlParser $htmlParser)
    {
    }

    public function getAllProductsLInks(array $queries): array
    {

        $allProducts = [];
        foreach ($queries as $query) {

            $page = $this->htmlFetcher->getPageHtml($query);

            $products = $this->htmlParser->getAllProductLinks($page);

            $allProducts = [...$allProducts, ...$products];

        }


        return $allProducts;
    }
}
