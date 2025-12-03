<?php

namespace App\Application\Shared\Exceptions;

class ApplicationException extends \Exception
{
    public function __construct(
        string $message = "Erro na aplicação",
        int $code = 400,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
