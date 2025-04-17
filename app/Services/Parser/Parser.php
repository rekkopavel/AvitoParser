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

    public function __construct(private queryRepository  $queryRepository,
                                private productExtractor $productExtractor,
                                private productManager   $productManager,
                                private LogService       $logService
    )
    {
    }

    public function runParsing(): void
    {
        try {
            $queries = $this->queryRepository->findActiveQueries();
            $products = $this->productExtractor->getAllProducts($queries);
            $productsCount = $this->productManager->save($products);
            $this->logService->info("Parser::class->runParsing() - '{$productsCount}' products has gotten ");
        } catch (\Throwable $e) {
            throw  ParserException::ProductsGettingExceptionHasBeenThrown($e);
        }

        try {
            if ($productsCount > 0) {
                event(new NewProductsFound($products));
                $this->logService->info('Subscribers have been notified!');
            }

        } catch (\Throwable $e) {
            throw  ParserException::NotificationExceptionHasBeenThrown($e);
        }

    }
}
