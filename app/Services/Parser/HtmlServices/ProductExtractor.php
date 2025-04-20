<?php

declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;

readonly class ProductExtractor
{
    public function __construct(
        private HtmlFetcher $htmlFetcher,
        private HtmlParser $htmlParser,
        private LogService $logService
    ) {}

    public function getAllProducts(array $queries): array
    {
        $allProducts = [];

        foreach ($queries as $query) {
            $title = $query['title'];
            $this->logService->info("Getting PageHtml for Query: {$title}..");
            $page = $this->htmlFetcher->getPageHtml($query);

            if (empty($page)) {
                $this->logService->warning("Html for Query: {$title} is empty, skipping.");

                continue;
            }

            $this->logService->info("Getting Products for Query: {$title}..");
            $products = $this->htmlParser->getProductsFromPage($page);

            if (empty($products)) {
                $this->logService->warning("Products array for Query: {$title} is empty, skipping.");

                continue;
            }

            foreach ($products as &$product) {
                $product['city'] = $query['city'];
            }
            unset($product); // Чтобы избежать багов с ссылкой

            $allProducts = array_merge($allProducts, $products);
        }

        if (empty($allProducts)) {
            throw new \Exception('Products for all Queries are empty');
        }

        return $allProducts;
    }
}
