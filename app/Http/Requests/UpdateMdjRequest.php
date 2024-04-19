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
            'instagram' => 'nullable|string|url',
            'logo' => [
                'nullable',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                'dimensions:min_width=100,min_height=100'
            ]

        ];
    }


    public function messages()
    {
        return [
            'postal_code.regex' => 'Le code postal doit être un numéro à 4 chiffres.',
            'tel.regex' => 'Le numéro de téléphone doit être un numéro belge valide, commençant par +32 ou 0, suivi directement par l’indicatif régional et le numéro local.',
            'logo.image' => 'Le fichier du logo doit être une image.',
            'logo.mimes' => 'Le logo doit être au format jpeg, png, jpg, gif, ou svg.',
            'logo.max' => 'Le logo ne doit pas dépasser 2MB.',
            'logo.dimensions' => 'Le logo doit avoir au moins 100x100 pixels.'
        ];
    }
}
