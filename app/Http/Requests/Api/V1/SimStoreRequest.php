<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SimStoreRequest extends FormRequest
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
            'mobile_number' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
                'min:11',
                'max:11',
                'unique:sim_ads,mobile_number',
            ],
            'type' => [
                'required',
                'in:for_sale,installment,loan',
            ],
            'price' => [
                'required',
                'numeric',
                'min:10000',
            ],
            'city' => [
                'required',
                'regex:/^[ا-ی\s]+$/u',
                'min:2',
            ],
            'expire_at' => [
                'nullable',
                Rule::date()->after(now()),
            ],
            'is_special' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'owner_name.required' => 'وارد کردن :attribute الزامی است.',
            'owner_name.regex' => ':attribute فقط باید شامل حروف فارسی باشد.',
            'owner_name.max' => ':attribute نباید بیشتر از :max کاراکتر باشد.',

            'mobile_number.required' => 'وارد کردن :attribute الزامی است.',
            'mobile_number.string' => ':attribute باید رشته باشد.',
            'mobile_number.regex' => ':attribute باید با 09 شروع شده و دقیقاً 11 رقم باشد.',
            'mobile_number.min' => ':attribute باید دقیقاً 11 رقم باشد.',
            'mobile_number.max' => ':attribute باید دقیقاً 11 رقم باشد.',
            'mobile_number.unique' => ':attribute قبلاً ثبت شده است.',

            'type.required' => 'انتخاب :attribute الزامی است.',
            'type.in' => ':attribute انتخاب‌شده معتبر نیست.',

            'price.required' => 'وارد کردن :attribute الزامی است.',
            'price.numeric' => ':attribute باید عددی باشد.',
            'price.min' => ':attribute نباید کمتر از :min تومان باشد.',

            'city.required' => 'وارد کردن :attribute الزامی است.',
            'city.regex' => ':attribute فقط باید شامل حروف فارسی باشد.',
            'city.min' => ':attribute باید حداقل :min کاراکتر باشد.',

            'expire_at.date' => ':attribute باید یک تاریخ معتبر باشد.',
            'expire_at.after' => ':attribute باید تاریخی بعد از امروز باشد.',

            'is_special.required' => 'وارد کردن :attribute الزامی است.',
            'is_special.boolean' => ':attribute باید مقدار بولی (true یا false) داشته باشد.',
        ];
    }

    public function attributes(): array
    {
        return [
            'owner_name' => 'نام مالک',
            'mobile_number' => 'شماره موبایل',
            'type' => 'نوع آگهی',
            'price' => 'قیمت',
            'city' => 'شهر',
            'expire_at' => 'تاریخ انقضا',
            'is_special' => 'وضعیت ویژه بودن',
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
