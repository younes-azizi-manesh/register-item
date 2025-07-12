<?php

namespace App\Services;

use App\Http\Resources\SimAdsResource;
use App\Repositories\Eloquent\SimAdRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class SimAdService
{
    public function __construct(private SimAdRepository $simRepository) {}

    public function createSimAd(array $data)
    {
        try {
            $simAd = $this->simRepository->create($data);
            return new SimAdsResource($simAd);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
