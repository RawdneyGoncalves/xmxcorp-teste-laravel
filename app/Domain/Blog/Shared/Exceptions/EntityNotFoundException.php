<?php

namespace App\Domain\Shared\Exceptions;

class EntityNotFoundException extends ApplicationException
{
    public function __construct(
        string $message = "Entidade não encontrada",
        int $code = 404,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
