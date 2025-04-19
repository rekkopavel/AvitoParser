<?php
declare(strict_types=1);

namespace App\Exceptions;

use App\Services\Parser\Parser;
use Throwable;

class ParserException extends AppMainException
{
    private const SOURCE_CLASS_NAME = Parser::class . ': ';

    public static function ProductsGettingExceptionHasBeenThrown(Throwable $e): self
    {
        return new self(self::formatMessage('ProductsGettingException', $e), $e->getCode(), $e);
    }

    public static function NotificationExceptionHasBeenThrown(Throwable $e): self
    {
        return new self(self::formatMessage('NotificationException', $e), $e->getCode(), $e);
    }

    public function report(): void
    {

            $this->logService->emergency(self::SOURCE_CLASS_NAME . $this->getMessage());

    }

    private static function formatMessage(string $context, Throwable $e): string
    {
        $message = "$context has been thrown ==> {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}";

        if ($previous = $e->getPrevious()) {
            $message .= "\nCaused by ==> {$previous->getFile()}:{$previous->getLine()} - {$previous->getMessage()}";
        }

        return $message;
    }
}

