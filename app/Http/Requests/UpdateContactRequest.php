<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'email' => 'sometimes|required|email|max:255',
            'sujet' => 'sometimes|required|string|max:255',
            'message' => 'sometimes|required|string|max:2000',
            'lu' => 'boolean',
            'repondu' => 'boolean',
            'reponse' => 'nullable|string|max:2000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est requis.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être au format valide.',
            'email.max' => 'L\'email ne peut pas dépasser 255 caractères.',
            'sujet.required' => 'Le sujet est requis.',
            'sujet.max' => 'Le sujet ne peut pas dépasser 255 caractères.',
            'message.required' => 'Le message est requis.',
            'message.max' => 'Le message ne peut pas dépasser 2000 caractères.',
            'lu.boolean' => 'Le statut lu doit être vrai ou faux.',
            'repondu.boolean' => 'Le statut répondu doit être vrai ou faux.',
            'reponse.max' => 'La réponse ne peut pas dépasser 2000 caractères.',
        ];
    }
}
