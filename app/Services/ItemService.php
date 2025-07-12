<?php

namespace App\Services;

use App\Http\Resources\ItemResource;
use App\Repositories\Eloquent\ItemRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ItemService
{
    public function __construct(private ItemRepository $itemRepository) {}

    public function createItem(array $data)
    {
        try {
            $item = $this->itemRepository->create($data);
            return new ItemResource($item);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
