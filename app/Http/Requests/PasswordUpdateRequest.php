<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required', 'min:6', 'confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Debes introducir o contrasinal actual',
            'new_password.required' => 'Debes introducir o novo contrasinal',
            'new_password.min' => 'Debes introducir al menos 6 caracteres',
            'new_password.confirmed' => 'O contrasinal non coincide',
        ];
    }
}
