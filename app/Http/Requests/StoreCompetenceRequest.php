<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetenceRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'niveau' => 'required|integer|min:0|max:100',
            'type' => 'required|string|in:Technique,Soft Skill',
            'description' => 'nullable|string|max:500',
            'etat' => 'required|string|in:Actif,Inactif',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la compétence est requis.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'niveau.required' => 'Le niveau de compétence est requis.',
            'niveau.integer' => 'Le niveau doit être un nombre entier.',
            'niveau.min' => 'Le niveau doit être au minimum 0.',
            'niveau.max' => 'Le niveau doit être au maximum 100.',
            'type.required' => 'Le type de compétence est requis.',
            'type.in' => 'Le type doit être Technique, Outil ou Soft Skill.',
            'description.max' => 'La description ne peut pas dépasser 500 caractères.',
            'etat.required' => 'L\'état de la compétence est requis.',
            'etat.in' => 'L\'état doit être Actif ou Inactif.',
        ];
    }
}
