<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjetRequest extends FormRequest
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
            'nom' => 'sometimes|required|string|max:255',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string|max:1000',
            'date' => 'nullable|date',
            'client' => 'nullable|string|max:255',
            'type' => 'sometimes|required|string|max:100',
            'url' => 'nullable|url|max:255',
            'technologies' => 'nullable|string',
            'technologies.*' => 'string|max:100',
            'etat' => 'sometimes|required|string|in:Actif,Inactif',
            'categorie_id' => 'nullable|exists:categories,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du projet est requis.',
            'nom.max' => 'Le nom du projet ne peut pas dépasser 255 caractères.',
            'photo1.image' => 'Le fichier photo1 doit être une image.',
            'photo1.mimes' => 'Le fichier photo1 doit être de type: jpeg, png, jpg, gif, webp.',
            'photo1.max' => 'Le fichier photo1 ne peut pas dépasser 2MB.',
            'photo2.image' => 'Le fichier photo2 doit être une image.',
            'photo2.mimes' => 'Le fichier photo2 doit être de type: jpeg, png, jpg, gif, webp.',
            'photo2.max' => 'Le fichier photo2 ne peut pas dépasser 2MB.',
            'photo3.image' => 'Le fichier photo3 doit être une image.',
            'photo3.mimes' => 'Le fichier photo3 doit être de type: jpeg, png, jpg, gif, webp.',
            'photo3.max' => 'Le fichier photo3 ne peut pas dépasser 2MB.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'date.date' => 'La date doit être au format valide.',
            'client.max' => 'Le nom du client ne peut pas dépasser 255 caractères.',
            'type.required' => 'Le type de projet est requis.',
            'type.max' => 'Le type ne peut pas dépasser 100 caractères.',
            'url.url' => 'L\'URL doit être au format valide.',
            'url.max' => 'L\'URL ne peut pas dépasser 255 caractères.',
            'etat.required' => 'L\'état du projet est requis.',
            'etat.in' => 'L\'état doit être Actif ou Inactif.',
            'categorie_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ];
    }
}
