<?php

namespace App\Services\Parser;

class htmlFetcher
{
    public function getHtml($rParseVersions)
    {

        $res = exec("node index.js --url=" . $rParseVersions->sUriSearch);

        $sHtml = file_get_contents('./temp/html.txt');


        return $sHtml;

    }
}
