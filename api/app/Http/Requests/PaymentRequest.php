<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'DOCUMENT' => 'required',
            'DUE_DAYS' => 'required',
            'EXPENSE_CODE' => 'required',
            'CURRENCY' => 'required',
            'EX_RATE' => 'required',
            'AMOUNT_TYPE' => 'required',
            'PERCENTAGE' => 'required',
            'PAYMENT_METHOD' => 'required',
        ];
    }
}
