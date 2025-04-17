<?php
namespace App\Exceptions;

class EmptyQueriesException extends \RuntimeException
{
    protected $message = 'No active queries available';
}
