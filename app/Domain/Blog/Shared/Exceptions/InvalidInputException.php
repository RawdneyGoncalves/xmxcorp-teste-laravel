<?php
namespace App\Domain\Blog\Shared\Exceptions;

class InvalidInputException extends ApplicationException
{
    public function __construct(
        string $message = "Entrada inválida",
        int $code = 422
    ) {
        parent::__construct($message, $code);
    }
}
