<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class AddWayBillRequest extends FormRequest
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
            'waybill' => 'required|string',
        ];
    }

    public function messages()
    {
        return[
            'waybill.required' => 'Це поле необхідно заповнити!',
            'waybill.string' => 'Можливо вводити тільки символи!',
        ];
    }
}
