<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ItemIndexRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

final class ItemController extends Controller
{
    public function __construct(
        private readonly ItemService $itemService,
    ) {
    }

    public function index(ItemIndexRequest $request): AnonymousResourceCollection
    {
        $response = $this->itemService->getAll(
            (int) $request->get('per_page'),
            $request->get('status')
        );

        return ItemResource::collection($response);
    }
}
