<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'required|boolean',
            'mdjExist' => 'sometimes|boolean',
            'mj' => 'required_if:mdjExist,false|string|max:255', // Requis si mdjExist est false
            'mjExist' => 'required_if:mdjExist,true|exists:mdjs,id', // Requis si mdjExist est true
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'L\'adresse e-mail est déjà utilisée par un autre compte.',
            'mj.required_if' => 'Le champ "Nom de la Mj" est obligatoire si vous n\'attribuez pas à une maison de jeunes existante.',
            'mjExist.required_if' => 'Vous devez sélectionner une maison de jeunes existante si l\'option est cochée.',
            'mjExist.exists' => 'La maison de jeunes sélectionnée n\'existe pas.',
        ];
    }
}
