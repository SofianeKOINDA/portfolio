<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormationRequest extends FormRequest
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
            'duree' => 'sometimes|required|string|max:255',
            'diplome' => 'sometimes|required|string|max:255',
            'etat' => 'sometimes|required|string|in:Actif,Inactif',
            'entreprise_id' => 'sometimes|required|exists:entreprises,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'duree.required' => 'La durée de la formation est requise.',
            'duree.max' => 'La durée ne peut pas dépasser 255 caractères.',
            'diplome.required' => 'Le diplôme est requis.',
            'diplome.max' => 'Le diplôme ne peut pas dépasser 255 caractères.',
            'etat.required' => 'L\'état de la formation est requis.',
            'etat.in' => 'L\'état doit être Actif ou Inactif.',
            'entreprise_id.required' => 'L\'entreprise/école est requise.',
            'entreprise_id.exists' => 'L\'entreprise/école sélectionnée n\'existe pas.',
        ];
    }
}
