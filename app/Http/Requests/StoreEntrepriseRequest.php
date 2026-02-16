<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntrepriseRequest extends FormRequest
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
            'adresse' => 'required|string|max:500',
            'tel1' => 'nullable|string|max:20',
            'tel2' => 'nullable|string|max:20',
            'site' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'type' => 'required|string|in:Entreprise,Ecole,Client',
            'etat' => 'required|string|in:Actif,Inactif',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l\'entreprise est requis.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'adresse.required' => 'L\'adresse est requise.',
            'adresse.max' => 'L\'adresse ne peut pas dépasser 500 caractères.',
            'tel1.max' => 'Le numéro de téléphone 1 ne peut pas dépasser 20 caractères.',
            'tel2.max' => 'Le numéro de téléphone 2 ne peut pas dépasser 20 caractères.',
            'site.url' => 'Le site web doit être une URL valide.',
            'site.max' => 'L\'URL du site ne peut pas dépasser 255 caractères.',
            'email.email' => 'L\'email doit être au format valide.',
            'email.max' => 'L\'email ne peut pas dépasser 255 caractères.',
            'type.required' => 'Le type d\'entreprise est requis.',
            'type.in' => 'Le type doit être Entreprise, Ecole ou Client.',
            'etat.required' => 'L\'état de l\'entreprise est requis.',
            'etat.in' => 'L\'état doit être Actif ou Inactif.',
        ];
    }
}
