<?php
declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;

readonly class  ProductExtractor
{
    public function __construct
    (
        private HtmlFetcher $htmlFetcher,
        private HtmlParser  $htmlParser,
        private LogService  $logService
    )
    {
    }

    public function getAllProducts(array $queries): array
    {

        $allProducts = [];
        foreach ($queries as $query) {

            $this->logService->info("Getting PageHtml for Query: {$query['title']}..");
            $page = $this->htmlFetcher->getPageHtml($query);
            if ($page === '') {
                $this->logService->warning("Html for Query: {{$query['title']} is empty, skip and continue}");
                continue;
            }

            $this->logService->info("Getting Products for Query: {$query['title']}..");
            $products = $this->htmlParser->getProductsFromPage($page);
            if ($products === []) {
                $this->logService->warning("Products array for Query: {{$query['title']} is empty, skip and continue}");
                continue;
            }

            foreach ($products as &$product) {
                $product['city'] = $query['city'];
            }
            unset($product); // чтобы избежать багов с ссылкой


            $allProducts = [...$allProducts, ...$products];

        }

        if ($allProducts === []) {
            throw new \Exception('Products for all  Queries is empty');
        }

        return $allProducts;
    }
}
