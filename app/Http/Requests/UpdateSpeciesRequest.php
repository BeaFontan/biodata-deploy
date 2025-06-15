<?php

namespace App\Http\Requests;

use App\Models\Species;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSpeciesRequest extends FormRequest
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
            'type' => 'required|in:' . Species::TYPE_ANIMAL .','. Species::TYPE_PLANT,
            'scientific_name' => 'required|max:200',
            'common_name' => 'max:100',
            'kingdom' => 'max:80',
            'phylum' => 'max:100',
            'class' => 'max:100',
            'order' => 'max:100',
            'family' => 'max:100',
            'genus' => 'max:100',
            'species_name' => 'max:150',
            'subspecies' => 'max:150',
            'images' => 'array',
            'images.*' => 'file|image|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Debes seleccionar un tipo de especie.',
            'type.in' => 'O tipo de especie debe ser "animal" ou "planta".',

            'scientific_name.required' => 'O nome científico é obrigatorio.',
            'scientific_name.max' => 'O nome científico non pode ter máis de 200 caracteres.',

            'common_name.max' => 'O nome común non pode ter máis de 100 caracteres.',
            'kingdom.max' => 'O reino non pode ter máis de 80 caracteres.',
            'phylum.max' => 'O filo non pode ter máis de 100 caracteres.',
            'class.max' => 'A clase non pode ter máis de 100 caracteres.',
            'order.max' => 'A orde non pode ter máis de 100 caracteres.',
            'family.max' => 'A familia non pode ter máis de 100 caracteres.',
            'genus.max' => 'O xénero non pode ter máis de 100 caracteres.',
            'species_name.max' => 'A especie non pode ter máis de 150 caracteres.',
            'subspecies.max' => 'A subespecie non pode ter máis de 150 caracteres.',

            'images.array' => 'O campo de imaxes debe ser un conxunto de arquivos.',
            'images.*.file' => 'Cada elemento debe ser un arquivo válido.',
            'images.*.image' => 'Cada arquivo debe ser unha imaxe válida (jpeg, png, etc.).',
            'images.*.max' => 'Cada imaxe non pode superar 1MB de tamaño.',
        ];
    }
}
