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

    public function create(array $data, int $userId): Item
    {
        $item = (new Item())->setStatus(StatusEnum::ACTIVE);

        $item->user_id = $userId;
        $item->name = $data['name'];
        $item->description = $data['description'];

        $item->save();

        return $item;
    }

    public function getById(int $id)
    {
        return Item::find($id);
    }

    public function update(Item $item, array $data): void
    {
        $item->update($data);
    }

    public function delete(Item $item): void
    {
        $item->delete();
    }
}
