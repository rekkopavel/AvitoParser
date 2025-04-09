<?php
declare(strict_types=1);

namespace App\Services\Parser\HtmlServices;

use App\Services\LogService;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class HtmlFetcher
{

    private const Kill_CHROME_COMMAND_IN_LINUX = 'pkill -f chrome';

    public function __construct(private LogService $logService)
    {
    }

    public function getPageHtml(array $query): string
    {
       // $this->killChrome();

        $process = new Process([
            'node',
            base_path('node-services/parser/index.js'),
            '--url='. $query['uri']
        ]);
        //$process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $html = $process->getOutput();
        //$err = $process->getErrorOutput();
       // $this->logService->info($html);
        //$error = $process->getErrorOutput();

        return $html;

    }

    public function killChrome(): void
    {
        $checkProcess = Process::fromShellCommandline('pgrep -f chrome');
        $checkProcess->run();
        try {
            if ($checkProcess->getOutput()) {
                $killProcess = Process::fromShellCommandline(self::Kill_CHROME_COMMAND_IN_LINUX);
                $killProcess->run();


            }
        } catch (\Throwable $e) {
            $this->logService->info("Attempt to kill chrome is unsuccessful or it is not working");
        }
    }
}
