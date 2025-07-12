<?php

use App\Http\Controllers\Api\V1\ItemController;
use App\Http\Controllers\Api\V1\SimAdsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    /**
     * items
     */
    Route::post('/items', [ItemController::class, 'store']);
    /**
     * sim Ads
     */
    Route::post('/sim-ads', [SimAdsController::class, 'store']);
});
