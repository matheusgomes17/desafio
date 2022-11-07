<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class UserNotFound extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct('Usuário não foi encontrado', $code, $previous);
    }
}
