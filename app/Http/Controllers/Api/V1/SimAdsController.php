<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Requests\Api\V1\SimStoreRequest;
use App\Services\SimAdService;

class SimAdsController extends ApiResponseController
{
    public function store(SimStoreRequest $request, SimAdService $simAdService) 
    {
        $validated = $request->validated();
        $simAd = $simAdService->createSimAd($validated);
        return $this->successResponse($simAd, 'success', 'آگهی با موفقیت ثبت شد', 201);
    }
}
