<?php
declare(strict_types=1);

namespace App\Exceptions;


use App\Services\Parser\Parser;


class ParserException extends AppMainException
{
    const SOURCE_CLASS_NAME = Parser::class;

    public static function ProductsGettingExceptionHasBeenThrown(\Throwable $e): self
    {
        $message = 'ProductsGettingException has been thrown, extra info - ' . $e->getFile() . ' Line: '. $e->getLine()  . ' '. $e->getMessage();
        return new self($message);
    }

    public static function NotificationExceptionHasBeenThrown(\Throwable $e): self
    {
        $message = 'NotificationException has been thrown, extra info - ' . $e->getFile() . ' Line: '.  $e->getLine() . ' '.  $e->getMessage();
        return new self($message);
    }

    public function report(): void
    {
        $this->logService->emergency(self::SOURCE_CLASS_NAME . $this->getMessage());
    }
}
