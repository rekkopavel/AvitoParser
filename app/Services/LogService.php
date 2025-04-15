<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Log;


class LogService
{
    public function emergency(string $message, \Throwable $error = null): void
    {
        $errorInfo = $this->getErrorInfo($error);
        Log::emergency($message . ($errorInfo ? "\n" . $errorInfo : ''));

    }

    public function alert(string $message, \Throwable $error = null): void
    {
        $errorInfo = $this->getErrorInfo($error);
        Log::alert($message . ($errorInfo ? "\n" . $errorInfo : ''));

    }

    public function critical(string $message, \Throwable $error = null): void
    {
        $errorInfo = $this->getErrorInfo($error);
        Log::critical($message . ($errorInfo ? "\n" . $errorInfo : ''));

    }

    public function error(string $message, \Throwable $error = null): void
    {
        $errorInfo = $this->getErrorInfo($error);
        Log::error($message . ($errorInfo ? "\n" . $errorInfo : ''));

    }

    public function warning(string $message): void
    {
        Log::warning($message);
    }

    public function notice(string $message): void
    {
        Log::notice($message);
    }

    public function info(string $message): void
    {
        Log::info($message);
    }

    public function debug (string $message): void
    {
        Log::debug($message);
    }

    private function getErrorInfo(?\Throwable $e): string
    {
        return $e ? "Additional information: {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}" : '';
    }

}
