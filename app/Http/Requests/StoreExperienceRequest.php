<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
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
            'poste' => 'required|string|max:255',
            'duree' => 'required|string|max:255',
            'tache' => 'nullable|string|max:1000',
            'etat' => 'required|string|in:Actif,Inactif',
            'entreprise_id' => 'nullable|exists:entreprises,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'poste.required' => 'Le poste est requis.',
            'poste.max' => 'Le poste ne peut pas dépasser 255 caractères.',
            'duree.required' => 'La durée de l\'expérience est requise.',
            'duree.max' => 'La durée ne peut pas dépasser 255 caractères.',
            'tache.required' => 'Les tâches sont requises.',
            'tache.max' => 'Les tâches ne peuvent pas dépasser 1000 caractères.',
            'etat.required' => 'L\'état de l\'expérience est requis.',
            'etat.in' => 'L\'état doit être Actif ou Inactif.',
            'entreprise_id.required' => 'L\'entreprise est requise.',
            'entreprise_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
        ];
    }
}
