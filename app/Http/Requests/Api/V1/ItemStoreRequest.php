<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'owner_name' => [
                'required',
                'regex:/^[ا-ی\s]+$/u',
                'max:50',
            ],
            'item_code' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
                'unique:items,item_code',
            ],
            'category' => [
                'required',
                'in:telecom,id_number,digital_code',
            ],
            'type' => [
                'required',
                'in:permanent,temporary',
            ],
            'price_suggestion' => [
                'required',
                'numeric',
                'min:10000',
            ],
            'location' => [
                'required',
                'regex:/^[ا-ی\s]+$/u',
                'min:2',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'owner_name.required' => 'وارد کردن :attribute الزامی است.',
            'owner_name.regex' => ':attribute فقط باید شامل حروف فارسی باشد.',
            'owner_name.max' => ':attribute نباید بیشتر از :max کاراکتر باشد.',

            'item_code.required' => 'وارد کردن :attribute الزامی است.',
            'item_code.string' => ':attribute باید رشته باشد.',
            'item_code.regex' => ':attribute باید با فرمت صحیح شروع با 09 و شامل 11 رقم باشد.',
            'item_code.unique' => ':attribute قبلاً ثبت شده است.',

            'category.required' => 'انتخاب :attribute الزامی است.',
            'category.in' => ':attribute انتخاب‌شده معتبر نیست.',

            'type.required' => 'انتخاب :attribute الزامی است.',
            'type.in' => ':attribute انتخاب‌شده معتبر نیست.',

            'price_suggestion.required' => 'وارد کردن :attribute الزامی است.',
            'price_suggestion.numeric' => ':attribute باید عددی باشد.',
            'price_suggestion.min' => ':attribute نباید کمتر از :min تومان باشد.',

            'location.required' => 'وارد کردن :attribute الزامی است.',
            'location.regex' => ':attribute فقط باید شامل حروف فارسی باشد.',
            'location.min' => ':attribute باید حداقل :min کاراکتر باشد.',
        ];
    }

    public function attributes(): array
    {
        return [
            'owner_name' => 'نام مالک',
            'item_code' => 'کد آیتم',
            'category' => 'دسته‌بندی',
            'type' => 'نوع',
            'price_suggestion' => 'قیمت پیشنهادی',
            'location' => 'موقعیت مکانی',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => $validator->errors(),
        ], 422));
    }
}
