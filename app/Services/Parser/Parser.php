<?php
declare(strict_types=1);

namespace App\Services\Parser;

use App\Events\NewProductsFound;
use App\Exceptions\ParserException;
use App\Services\LogService;
use App\DataBaseManagers\ProductManager;
use App\Services\Parser\HtmlServices\ProductExtractor;
use App\Repository\QueryRepository;

readonly class Parser
{

    public function __construct(
        private QueryRepository  $queryRepository,
        private ProductExtractor $productExtractor,
        private ProductManager   $productManager,
        private LogService       $logService
    )
    {
    }

    public function runParsing(): void
    {

        $products = [];
        $productsCount = 0;

        try {
            $products = $this->extractAndSaveProducts();
            $productsCount = count($products);
            $this->logService->info("Parser::runParsing() - '{$productsCount}' products retrieved and saved.");
        } catch (\Throwable $e) {
            throw ParserException::ProductsGettingExceptionHasBeenThrown($e);
        }


        try {
            event(new NewProductsFound($products));
            $this->logService->info('Subscribers have been notified!');
        } catch (\Throwable $e) {
            throw ParserException::NotificationExceptionHasBeenThrown($e);
        }

    }

    private function extractAndSaveProducts(): array
    {
        $queries = $this->queryRepository->findActiveQueries();
        $products = $this->productExtractor->getAllProducts($queries);
        $this->productManager->save($products);
        return $products;
    }
}
