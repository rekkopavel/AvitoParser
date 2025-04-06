<?php

namespace App\Services\Parser;

class htmlFetcher
{
    private const Kill_CHROME_COMMAND = 'taskkill /f /t /im chrome.exe';

    public function getHtml($rParseVersions)
    {

        $res = exec("node index.js --url=" . $rParseVersions->sUriSearch);

        $sHtml = file_get_contents('./temp/html.txt');


        return $sHtml;

    }
}
