<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMdjRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'objective' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|numeric|regex:/^\d{4}$/',
            'tel' => [
                'nullable',
                'regex:/^(\+32|0)/', // Commence par +32 ou 0
                'regex:/\d{1,2}/',  // 1 ou 2 chiffres pour l'indicatif régional
                'regex:/\d{3}\s?\/?\s?\d{2}\s?\/?\s?\d{2}$/' // Format des numéros locaux avec espaces et slashes optionnels
            ],
            'email' => 'nullable|string|email:rfc,dns|max:255',
            'site' => 'nullable|string|url',
            'facebook' => 'nullable|string|url',
            'instagram' => 'nullable|string|url'
        ];
    }


    public function messages()
    {
        return [
            'postal_code.regex' => 'Le code postal doit être un numéro à 4 chiffres.',
            'tel.regex' => 'Le numéro de téléphone doit être un numéro belge valide, commençant par +32 ou 0, suivi d’un chiffre entre 1 et 9, puis de 6 à 10 chiffres supplémentaires.',
            'email.regex' => "Veuiller entrer un format d'email valide."
        ];
    }
}
