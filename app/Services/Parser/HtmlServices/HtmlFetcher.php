<?php

namespace App\Services\Parser\HtmlServices;

class HtmlFetcher
{
    private const Kill_CHROME_COMMAND = 'taskkill /f /t /im chrome.exe';

    public function getPageHtml($rParseVersions)
    {

        $res = exec("node index.js --url=" . $rParseVersions->sUriSearch);

        $sHtml = file_get_contents('./temp/html.txt');


        return $sHtml;

    }
}
