<?php
declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;

class ProductExtractor
{
    public function __construct(private HtmlFetcher $htmlFetcher, private HtmlParser $htmlParser,private LogService $logService)
    {
    }

    public function getAllProductsLInks(array $queries): array
    {

        $allProducts = [];
        foreach ($queries as $query) {
            try {
                $page = $this->htmlFetcher->getPageHtml($query);
            } catch (\Throwable $e){
                $this->logService->info("Html for query {$query['title']} has not got..skip and next");
            }

            try {
            $products = $this->htmlParser->getAllProductLinks($page);
            } catch (\Throwable $e){
                $this->logService->info("Products for query {$query['title']} has not got..skip and next");
            }

            $allProducts = [...$allProducts, ...$products];

        }


        return $allProducts;
    }
}
