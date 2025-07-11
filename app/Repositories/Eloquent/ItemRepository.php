<?php

namespace App\Repositories\Eloquent;

use App\Models\Item;

class ItemRepository
{
    public function __construct(private Item $model)
    {}

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}