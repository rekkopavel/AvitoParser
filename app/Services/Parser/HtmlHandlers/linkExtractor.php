<?php

namespace App\Services\Parser;

use App\DTO\QueryParamsDTO;

class linkExtractor
{
    private const Kill_CHROME_COMMAND = 'taskkill /f /t /im chrome.exe';

    public function getProductsLinks():?array
    {

        $arrayQueryDto = [];
        foreach (config('parser.queries') as $query){
            $arrayQueryDto[] = QueryParamsDTO::fromConfig($query);
        }
       $this->
return [];
    }
}
