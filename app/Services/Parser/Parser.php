<?php
declare(strict_types=1);

namespace App\Services\Parser;

use App\Services\Parser\linkExtractor;

class Parser
{
    private const Kill_CHROME_COMMAND = 'taskkill /f /t /im chrome.exe';

    public function runParsing(linkExtractor $linkExtractor, linkSaver $linkSaver):void
    {

        $productsUris = $linkExtractor->getProductsLinks();

        $linkSaver->saveLinksToBase($productsUris);

    }



}
