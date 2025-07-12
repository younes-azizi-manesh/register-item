<?php

namespace App\Services;

use App\Http\Resources\SimAdsResource;
use App\Repositories\Eloquent\SimAdRepository;

class SimAdService
{
    public function __construct(private SimAdRepository $simRepository) {}

    public function createSimAd(array $data)
    {
        $simAd = $this->simRepository->create($data);
        return new SimAdsResource($simAd);
    }
}
