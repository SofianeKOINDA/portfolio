<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'nom' => [
                'sometimes', //Ignorer complètement la validation du champ nom s’il n’est pas dans la requête.
                'required',
                'string',
                'max:255',
                //être unique dans la table categories, sauf pour la catégorie actuelle (ignore)
                Rule::unique('categories', 'nom')->ignore($this->categorie),
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la catégorie est requis.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'nom.unique' => 'Une catégorie avec ce nom existe déjà.',
        ];
    }
}
