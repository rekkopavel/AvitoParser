<?php
declare(strict_types=1);

namespace App\Exceptions;

use App\Services\LogService;
use Exception;

class AppMainException extends Exception
{
    protected LogService $logService;

    public function __construct( string $message = "", int $code = 0, ?\Throwable $previous = null )
    {
        parent::__construct($message, $code, $previous);

        $this->logService = new LogService();//TODO сделать через иньекцию
    }
}
