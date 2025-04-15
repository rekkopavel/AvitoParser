<?php
declare(strict_types=1);

namespace App\Exceptions;


use App\Services\Parser\Parser;


class ParserException extends AppMainException
{
    const SOURCE_CLASS_NAME = Parser::class.': ';

    public static function ProductsGettingExceptionHasBeenThrown(\Throwable $e): self
    {
        $message = "ProductsGettingException has been thrown ==> {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}";
        if ($previous = $e->getPrevious()) {
            $message .= "\nCaused by ==> {$previous->getFile()}:{$previous->getLine()} - {$previous->getMessage()}";
        }


        return new self($message);
    }

    public static function NotificationExceptionHasBeenThrown(\Throwable $e): self
    {
        $message = "NotificationException has been thrown ==>: {$e->getFile()}:{$e->getLine()} - {$e->getMessage()}";
        if ($previous = $e->getPrevious()) {
            $message .= "\nCaused by ==> {$previous->getFile()}:{$previous->getLine()} - {$previous->getMessage()}";
        }


        return new self($message);
    }

    public function report(): void
    {
        $this->logService->emergency(self::SOURCE_CLASS_NAME . $this->getMessage());
    }
}
