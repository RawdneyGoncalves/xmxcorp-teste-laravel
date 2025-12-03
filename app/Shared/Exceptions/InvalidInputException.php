<?php
namespace App\Application\Shared\Exceptions;

class InvalidInputException extends ApplicationException
{
    public function __construct(
        string $message = "Entrada inválida",
        int $code = 422,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
