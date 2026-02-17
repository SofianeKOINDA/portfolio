<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'nom' => 'required|string|max:255|unique:categories,nom',
            'etat' => 'required|string|in:Actif,Inactif',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la catégorie est requis.',
            'nom.string' => 'Le nom de la categorie doit etre une chaine de caractere.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'nom.unique' => 'Une catégorie avec ce nom existe déjà.',
            'etat.required' => 'L\'état de la catégorie est requis.',
            'etat.string' => 'L\'état doit être une chaîne de caractères.',
            'etat.in' => 'L\'état doit être soit "Actif" soit "Inactif".',
        ];
    }
}
