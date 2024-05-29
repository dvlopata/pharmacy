<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required|string',
            'recommendation' => 'required|string',
            'composition' => 'required|string',
            'methodApplication' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'subcategory_id' => 'required|integer|exists:subcategories,id',
            'manufacturer_id' => 'required|integer|exists:manufacturers,id',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Це поле необхідно заповнити!',
            'name.string' => 'Можливо вводити тільки символи!',
            'price.required' => 'Це поле необхідно заповнити!',
            'price.numeric' => 'Можливо вводити тільки числа!',
            'quantity.required' => 'Це поле необхідно заповнити!',
            'quantity.numeric' => 'Можливо вводити тільки числа!',
            'description.required' => 'Це поле необхідно заповнити!',
            'description.string' => 'Можливо вводити тільки символи!',
            'recommendation.required' => 'Це поле необхідно заповнити!',
            'recommendation.string' => 'Можливо вводити тільки символи!',
            'composition.required' => 'Це поле необхідно заповнити!',
            'composition.string' => 'Можливо вводити тільки символи!',
            'methodApplication.required' => 'Це поле необхідно заповнити!',
            'methodApplication.string' => 'Можливо вводити тільки символи!',
            'image.required' => 'Це поле необхідно заповнити!',
            'image.image' => 'Вибраний файл має бути зображенням!',
            'image.mimes' => 'Зображення повинно бути у форматі: jpeg, png, jpg, gif, або svg!',
            'image.max' => 'Розмір зображення не повинен перевищувати 2048 кілобайтів!',
            'subcategory_id.required' => 'Це поле необхідно заповнити!',
            'subcategory_id.integer' => 'Це поле повинно містити число!',
            'manufacturer_id.required' => 'Це поле необхідно заповнити!',
            'manufacturer_id.integer' => 'Це поле повинно містити число!',
        ];
    }
}
