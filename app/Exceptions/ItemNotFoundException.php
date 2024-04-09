<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

final class ItemNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('item_not_found', Response::HTTP_NOT_FOUND);
    }
}
