<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Log;

use Psr\Log\LoggerInterface;

class LogService implements LoggerInterface
{
    public function emergency($message, array $context = []): void
    {
        $errorInfo = $this->getErrorInfo($context['exception'] ?? null);
        Log::emergency($message . ($errorInfo ? "\n" . $errorInfo : ''), $context);
    }

    public function alert($message, array $context = []): void
    {
        $errorInfo = $this->getErrorInfo($context['exception'] ?? null);
        Log::alert($message . ($errorInfo ? "\n" . $errorInfo : ''), $context);
    }

    public function critical($message, array $context = []): void
    {
        $errorInfo = $this->getErrorInfo($context['exception'] ?? null);
        Log::critical($message . ($errorInfo ? "\n" . $errorInfo : ''), $context);
    }

    public function error($message, array $context = []): void
    {
        $errorInfo = $this->getErrorInfo($context['exception'] ?? null);
        Log::error($message . ($errorInfo ? "\n" . $errorInfo : ''), $context);
    }

    public function warning($message, array $context = []): void
    {
        Log::warning($message, $context);
    }

    public function notice($message, array $context = []): void
    {
        Log::notice($message, $context);
    }

    public function info($message, array $context = []): void
    {
        Log::info($message, $context);
    }

    public function debug($message, array $context = []): void
    {
        Log::debug($message, $context);
    }

    public function log($level, $message, array $context = []): void
    {
        Log::log($level, $message, $context);
    }

    private function getErrorInfo(?\Throwable $e = null): string
    {
        return $e ? "Additional information: {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}" : '';
    }
}
