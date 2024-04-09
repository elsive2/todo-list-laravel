<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\ItemNotFoundException;

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

    public function create(array $data, int $userId): Item
    {
        return $this->repository->create($data, $userId);
    }

    public function getById(int $id)
    {
        $item = $this->repository->getById($id);

        if ($item === null) {
            throw new ItemNotFoundException();
        }

        return $item;
    }

    public function update(array $data, int $id): Item
    {
        $item = $this->getById($id);

        $this->repository->update($item, $data);

        return $item;
    }

    public function delete(int $id): void
    {
        $item = $this->getById($id);

        $this->repository->delete($item);
    }
}
