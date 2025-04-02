<?php
declare(strict_types=1);

namespace App\Services\Parser;

use App\Events\NewProdutsFound;
use App\Services\Parser\linkExtractor;

class Parser
{


    private linkExtractor $linkExtractor;
    private linkSaver $linkSaver;

    public function __construct(linkExtractor $linkExtractor, linkSaver $linkSaver)
    {
        $this->linkExtractor = $linkExtractor;
        $this->linkSaver = $linkSaver;
    }

    public function runParsing(): ?int
    {
        $productsLinks = $this->linkExtractor->getProductsLinks();
        $linksNumber = $this->linkSaver->saveLinksToBase($productsLinks);

        if ($linksNumber > 0) {
            event(new NewProdutsFound());
        }
        return $linksNumber;
    }
}
