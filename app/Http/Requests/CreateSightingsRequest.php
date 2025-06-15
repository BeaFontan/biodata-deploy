<?php

namespace App\Http\Requests;

use App\Models\Species;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSightingsRequest extends FormRequest
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
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'individuals' => 'required|integer|min:1',
            'observed_at' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.required' => 'Por favor, introduce a latitude.',
            'latitude.numeric' => 'A latitude debe ser un número válido.',

            'longitude.required' => 'Por favor, introduce a lonxitude.',
            'longitude.numeric' => 'A lonxitude debe ser un número válido.',

            'individuals.required' => 'Indica o número de exemplares.',
            'individuals.integer' => 'Debe ser un número enteiro.',
            'individuals.min' => 'Debe haber polo menos un exemplar.',

            'observed_at.required' => 'Indica a data de observación.',
            'observed_at.date' => 'Introduce unha data válida.',
        ];
    }
}
