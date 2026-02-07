<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class UpdateVoucherRequest extends FormRequest
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
            'insurance_id' => ['required', 'uuid', 'max:255'],
            'discount_type' => ['required', 'in:percent,fixed'],
            'discount_value' => ['required', 'numeric'],
            'max_discount' => ['sometimes', 'numeric', 'nullable'],
            'start_date' => ['sometimes', 'date', 'nullable'],
            'end_date' => ['sometimes', 'date', 'nullable', 'after_or_equal:start_date'],
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        $voucherId = $this->route('voucher');

        throw new HttpResponseException(
            redirect()
                ->route('voucher.edit', $voucherId)
                ->withErrors($validator)
        );
    }
}
