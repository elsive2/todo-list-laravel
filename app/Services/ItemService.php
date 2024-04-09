<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ItemRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class ItemService
{
    public function __construct(
        private ItemRepository $repository,
    ) {
    }

    public function getAll(?int $perPage, ?string $status = null): LengthAwarePaginator
    {
        return $this->repository->getAll($perPage ?: 10, $status);
    }
}
