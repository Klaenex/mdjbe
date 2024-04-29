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
                'mimes:jpeg,png,jpg,gif,svg,webp',
                'max:2048',
                'dimensions:min_width=100,min_height=100'
            ],
            'image1' => [
                'nullable',
                'file',
                'image',
                'mimes:jpeg,png,jpg,svg,webp',
                'max:2048',
                'dimensions:min_width=100,min_height=100'
            ],
            'image2' => [
                'nullable',
                'file',
                'image',
                'mimes:jpeg,png,jpg,svg,webp',
                'max:4096',
                'dimensions:min_width=100,min_height=100'
            ],
            'dispositif_particulier' => 'nullable|string',
            'projects.*.id' => 'sometimes|exists:projet_porteur,id',
            'projects.*.name' => 'required|string|max:255',
        ];
    }


    public function messages()
    {
        return [
            'postal_code.regex' => 'Le code postal doit être un numéro à 4 chiffres.',
            'tel.regex' => 'Le numéro de téléphone doit être un numéro belge valide, commençant par +32 ou 0, suivi directement par l’indicatif régional et le numéro local.',
            'logo.image' => 'Le fichier du logo doit être une image.',
            'logo.mimes' => 'Le logo doit être au format jpeg, png, jpg, gif, ou svg.',
            'logo.max' => 'Le logo ne doit pas dépasser 4MB.',
            'logo.dimensions' => 'Le logo doit avoir au moins 100x100 pixels.',
            'image1.image' => 'Le fichier de l’image 1 doit être une image.',
            'image1.mimes' => 'L’image 1 doit être au format jpeg, png, jpg, gif, ou svg.',
            'image1.max' => 'L’image 1 ne doit pas dépasser 2MB.',
            'image1.dimensions' => 'L’image 1 doit avoir au moins 100x100 pixels.',
            'image2.image' => 'Le fichier de l’image 2 doit être une image.',
            'image2.mimes' => 'L’image 2 doit être au format jpeg, png, jpg, gif, ou svg.',
            'image2.max' => 'L’image 2 ne doit pas dépasser 2MB.',
            'image2.dimensions' => 'L’image 2 doit avoir au moins 100x100 pixels.',
            'projects.*.id.exists' => 'Le projet spécifié n’existe pas.',
            'projects.*.name.required' => 'Le nom du projet est obligatoire.',
            'projects.*.name.string' => 'Le nom du projet doit être une chaîne de caractères.',
            'projects.*.name.max' => 'Le nom du projet ne peut pas dépasser 255 caractères.',
        ];
    }
}
