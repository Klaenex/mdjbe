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
            'tel' => 'nullable|regex:/^(\+32|0)[1-9](\d{1,2}\d{6}|\d{8})$/',

        ];
    }
    public function messages()
    {
        return [
            'postal_code.regex' => 'Le code postal doit être un numéro à 4 chiffres.',
            'tel.regex' => 'Le numéro de téléphone doit être un numéro belge valide, commençant par +32 ou 0, suivi d’un chiffre entre 1 et 9, puis de 6 à 10 chiffres supplémentaires.',
        ];
    }
}
