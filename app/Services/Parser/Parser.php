<?php
declare(strict_types=1);

namespace App\Services\Parser;

use App\Events\NewProductsFound;
use App\Exceptions\ParserException;
use App\Services\LogService;
use App\DataBaseManagers\ProductManager;
use App\Services\Parser\HtmlServices\ProductExtractor;
use App\Repository\QueryRepository;

class Parser
{


    public function __construct(private queryRepository  $queryRepository,
                                private productExtractor $productExtractor,
                                private productManager   $productManager,
                                private LogService       $logService
    )
    {
    }

    public function runParsing(): ?int
    {
        try {
            $queriesArray = $this->queryRepository->findAllActiveQueries();
            $productsArray = $this->productExtractor->getAllProducts($queriesArray);
            $productsNumber = $this->productManager->save($productsArray);
            $this->logService->success("Parser::class->runParsing() - getting '{$productsNumber}' products ");
        } catch (\Throwable $e) {
            throw  ParserException::ProductsGettingExceptionHasBeenThrown($e);
        }

        try {
            if ($productsNumber > 0) {
                event(new NewProductsFound($productsArray));
                $this->logService->success('Parser::class->runParsing() - notification users event made ');
            }

        } catch (\Throwable $e) {
            throw  ParserException::NotificationExceptionHasBeenThrown($e);
        }
        return $productsNumber;
    }
}
