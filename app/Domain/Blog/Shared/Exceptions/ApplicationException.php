<?php

namespace App\Domain\Blog\Shared\Exceptions;

class ApplicationException extends \Exception
{
    public function __construct(
        string $message = "Erro na aplicação",
        int $code = 400
    ) {
        parent::__construct($message, $code);
    }
}
