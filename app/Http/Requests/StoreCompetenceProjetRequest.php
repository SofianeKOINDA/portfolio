<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetenceProjetRequest extends FormRequest
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
            'competence_id' => 'required|exists:competences,id',
            'projet_id' => 'required|exists:projets,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'competence_id.required' => 'La compétence est requise.',
            'competence_id.exists' => 'La compétence sélectionnée n\'existe pas.',
            'projet_id.required' => 'Le projet est requis.',
            'projet_id.exists' => 'Le projet sélectionné n\'existe pas.',
        ];
    }
}
