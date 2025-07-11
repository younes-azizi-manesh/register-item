<?php

use App\Http\Controllers\Api\V1\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->post('/items', [ItemController::class, 'store']);
