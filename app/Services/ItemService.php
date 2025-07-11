<?php

namespace App\Services;

use App\Repositories\Eloquent\ItemRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ItemService
{
    public function __construct(private ItemRepository $itemRepository) {}

    public function createItem(array $data)
    {
        try{
            return $this->itemRepository->create($data);
        }catch(Exception $e){
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
