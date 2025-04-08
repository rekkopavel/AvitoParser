<?php
declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class HtmlFetcher
{
    private const Kill_CHROME_COMMAND = 'taskkill /f /t /im chrome.exe';

    public function getPageHtml(array $query): string
    {
        $this->killChrome();

        $process = new Process([
            'node',
            base_path('node-services/parser/index.js'),
            '--url=' . $query['uri']
        ]);
        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $html = $process->getOutput();

        return $html;

    }

    private function killChrome(): void
    {
        $process = Process::fromShellCommandline(self::Kill_CHROME_COMMAND);
        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }


    }
}
