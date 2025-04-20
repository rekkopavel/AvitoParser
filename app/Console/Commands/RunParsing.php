<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Parser\Parser;
use Illuminate\Console\Command;

class RunParsing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Do parsing and write data  to database';

    public function __construct(
        private readonly Parser $parser
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->parser->runParsing();
        $this->info('Parsing completed successfully.');

        return self::SUCCESS;
    }
}
