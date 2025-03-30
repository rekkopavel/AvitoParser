<?php
declare(strict_types=1);

namespace App\Services\Parser;

use App\Events\NewProdutsFound;
use App\Services\Parser\linkExtractor;

class Parser
{
    private const Kill_CHROME_COMMAND = 'taskkill /f /t /im chrome.exe';

    public function runParsing(linkExtractor $linkExtractor, linkSaver $linkSaver,): void
    {

        $productsUris = $linkExtractor->getProductsLinks();

        $uriQuantity = $linkSaver->saveLinksToBase($productsUris);

        if ($uriQuantity > 0) {
            event(new NewProdutsFound());
        }

    }


}
