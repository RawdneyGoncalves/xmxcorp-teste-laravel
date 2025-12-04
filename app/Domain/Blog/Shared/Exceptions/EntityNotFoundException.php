<?php

namespace App\Domain\Blog\Shared\Exceptions;

class EntityNotFoundException extends ApplicationException
{
    public function __construct(
        string $message = "Entidade não encontrada",
        int $code = 404
    ) {
        parent::__construct($message, $code );
    }
}
