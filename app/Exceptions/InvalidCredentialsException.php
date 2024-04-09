<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class InvalidCredentialsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('invalid_credentials', Response::HTTP_UNAUTHORIZED);
    }
}
