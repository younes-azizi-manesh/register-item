<?php

namespace App\Repositories\Eloquent;

use App\Models\SimAd;

class SimAdRepository
{
    public function __construct(private SimAd $model) {}

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
