<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Requests\Api\V1\ItemStoreRequest;
use App\Services\ItemService;


/**
 * @OA\Info(
 *     title="سامانه ثبت آگهی",
 *     version="1.0.0",
 *     description="مستندات API برای ثبت آگهی"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="سرور اصلی"
 * )
 */
class ItemController extends ApiResponseController
{
    /**
     * @OA\Post(
     *     path="/api/v1/items",
     *     summary="ثبت آگهی جدید",
     *     tags={"Items"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"owner_name", "item_code", "category", "type", "price_suggestion", "location"},
     *             @OA\Property(property="owner_name", type="string", example="یونس عزیزی منش"),
     *             @OA\Property(property="item_code", type="string", example="09927814012"),
     *             @OA\Property(property="category", type="string", enum={"telecom","id_number","digital_code"}, example="telecom"),
     *             @OA\Property(property="type", type="string", enum={"permanent","temporary"}, example="permanent"),
     *             @OA\Property(property="price_suggestion", type="number", example=150000),
     *             @OA\Property(property="location", type="string", example="تهران")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="آگهی با موفقیت ثبت شد",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="آگهی با موفقیت ثبت شد"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=7),
     *                 @OA\Property(property="item_code", type="string", example="09927814012")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="خطا در اعتبارسنجی",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="object",
     *                 @OA\Property(property="item_code", type="array",
     *                     @OA\Items(type="string", example="کد آیتم قبلاً ثبت شده است.")
     *                 ),
     *                 @OA\Property(property="location", type="array",
     *                     @OA\Items(type="string", example="موقعیت مکانی فقط باید شامل حروف فارسی باشد."),
     *                     @OA\Items(type="string", example="موقعیت مکانی باید حداقل 2 کاراکتر باشد.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(ItemStoreRequest $request, ItemService $itemService)
    {
        $validated = $request->validated();
        $item = $itemService->createItem($validated);
        return $this->successResponse($item, "success", "آگهی با موفقیت ثبت شد", 201);
    }
}
