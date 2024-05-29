<?php

namespace App\Http\Requests\Admin\User;

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
            'name' => 'required|string',
            'surname' => 'required|string',
            'dateOfBirth' => 'required|date',
            'phone' => 'required|string',
            'email' => 'required|string|email|unique:users, email,' . $this->user_id,
            'address' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'postNumber' => 'required|string',
            'user_id' => 'required|integer|exists:users,id'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Це поле необхідно заповнити!',
            'name.string' => 'Можливо вводити тільки символи!',
            'surname.required' => 'Це поле необхідно заповнити!',
            'surname.string' => 'Можливо вводити тільки символи!',
            'dateOfBirth.required' => 'Це поле необхідно заповнити!',
            'dateOfBirth.date' => 'Поле повинно відповідати формату дати!',
            'phone.required' => 'Це поле необхідно заповнити!',
            'phone.string' => 'Можливо вводити тільки символи!',
            'address.required' => 'Це поле необхідно заповнити!',
            'address.string' => 'Можливо вводити тільки символи!',
            'city.required' => 'Це поле необхідно заповнити!',
            'city.string' => 'Можливо вводити тільки символи!',
            'region.required' => 'Це поле необхідно заповнити!',
            'region.string' => 'Можливо вводити тільки символи!',
            'postNumber.required' => 'Це поле необхідно заповнити!',
            'postNumber.string' => 'Можливо вводити тільки символи!',
            'email.required' => 'Це поле необхідно заповнити!',
            'email.string' => 'Можливо вводити тільки символи!',
            'email.email'=> 'Поле повинно бути записано у форматі mail@some.domain',
            'email.unique' => 'Користувач з таким email вже існує!',
        ];
    }
}
