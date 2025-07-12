<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Requests\Api\V1\SimStoreRequest;
use App\Services\SimAdService;

class SimAdsController extends ApiResponseController
{
    /**
     * @OA\Post(
     *     path="/api/v1/sim-ads",
     *     summary="ثبت آگهی سیم‌کارت",
     *     tags={"Sim Ads"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"owner_name", "mobile_number", "type", "price_suggestion", "city", "is_special"},
     *             @OA\Property(property="owner_name", type="string", example="یونس عزیزی منش"),
     *             @OA\Property(property="mobile_number", type="string", example="09927814012"),
     *             @OA\Property(property="type", type="string", enum={"for_sale", "installment", "loan"}, example="for_sale"),
     *             @OA\Property(property="price_suggestion", type="number", example=150000),
     *             @OA\Property(property="city", type="string", example="تهران"),
     *             @OA\Property(property="expire_at", type="string", format="date", example="2025-12-31"),
     *             @OA\Property(property="is_special", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="آگهی با موفقیت ثبت شد",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="آگهی با موفقیت ثبت شد"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="mobile_number", type="string", example="09927814012")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="خطا در اعتبارسنجی",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="object",
     *                 @OA\Property(property="mobile_number", type="array",
     *                     @OA\Items(type="string", example="شماره موبایل قبلاً ثبت شده است.")
     *                 ),
     *                 @OA\Property(property="price_suggestion", type="array",
     *                     @OA\Items(type="string", example="قیمت نباید کمتر از 10000 تومان باشد.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function store(SimStoreRequest $request, SimAdService $simAdService)
    {
        $validated = $request->validated();
        $simAd = $simAdService->createSimAd($validated);
        return $this->successResponse($simAd, 'success', 'آگهی با موفقیت ثبت شد', 201);
    }
}
