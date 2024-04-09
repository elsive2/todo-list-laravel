<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\StatusEnum;
use App\Models\Item;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class ItemRepository
{
    public function getAll(int $perPage, ?string $status): LengthAwarePaginator
    {
        $query = Item::query()->with('user');

        if ($status && StatusEnum::tryFrom($status)) {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }
}
