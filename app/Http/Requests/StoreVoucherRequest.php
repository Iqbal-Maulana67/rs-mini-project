<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherRequest extends FormRequest
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
            'insurance_id' => ['required', 'uuid'],
            'discount_type' => ['required', 'string', 'in:percent,fixed'],
            'discount_value'=> ['required', 'numeric'],
            'max_discount' => ['sometimes', 'numeric', 'nullable'],
            'start_date' => ['sometimes', 'date', 'nullable'],
            'end_date' => ['sometimes', 'date', 'nullable']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return redirect()->route('voucher.create')->withErrors($validator);
    }
}
