<?php
declare(strict_types=1);

namespace App\Services\Parser;

use App\Events\NewProductsFound;
use App\Services\Parser\DataBaseManagers\productManager;
use App\Services\Parser\HtmlServices\productExtractor;
use App\Services\Parser\Repositories\queryRepository;

class Parser
{


    public function __construct(private queryRepository $queryRepository, private productExtractor $productExtractor, private productManager $productManager)
    {
    }

    public function runParsing(): ?int
    {
        $queriesArray = $this->queryRepository->findAllQueries();
        $productsLinksArray = $this->productExtractor->getAllProductsLinks($queriesArray);
        $productsNumber = $this->productManager->save($productsLinksArray);

        if ($productsNumber > 0) {
            event(new NewProductsFound($productsLinksArray));
        }
        return $productsNumber;
    }
}
