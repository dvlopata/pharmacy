<?php

namespace App\Http\Requests\Admin\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'address' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
        ];
    }

    public function messages()
    {
        return[
            'address.required' => 'Це поле необхідно заповнити!',
            'address.string' => 'Можливо вводити тільки символи!',
            'city.required' => 'Це поле необхідно заповнити!',
            'city.string' => 'Можливо вводити тільки символи!',
            'region.required' => 'Це поле необхідно заповнити!',
            'region.string' => 'Можливо вводити тільки символи!',
        ];
    }
}
