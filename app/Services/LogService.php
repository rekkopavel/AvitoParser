<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogService
{
    const SUCCESS_MESSAGE = 'Successfully!';

    public function success(string $sourceMessage): void
    {
        Log::info($sourceMessage . self::SUCCESS_MESSAGE);

    }

    public function info(string $message): void
    {
        Log::info($message);

    }

    public function warning(string $message): void
    {
        Log::emergency($message);

    }

    public function emergency(string $message): void
    {
        Log::emergency($message);

    }

}
