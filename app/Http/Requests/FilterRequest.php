<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'name' => ['nullable','string', 'min:3'],
            'firstname' => ['nullable','string', 'min:3'],
            'email' => ['nullable','string', 'min:3'], // type string pour filtrer sur une adresse mail partielle
            'adresse' => ['nullable','string', 'min:10'],
            'code_postal' => ['nullable','integer', 'regex:/^[0-9]{5}$/'],
            'ville' => ['nullable','string', 'min:3'],
            'fonction' => ['nullable','string', 'min:3'],
            'date_debut' => ['nullable','date'],
            'date_fin' => ['nullable','date'],
            'cdd' => ['nullable'],
            'cdi' => ['nullable'],
            'fonctions_id' => ['nullable','integer'],
            'mode' => ['nullable','string'],

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.min' => 'Le champ doit contenir au moins 3 caractères',
            'firstname.min' => 'Le champ doit contenir au moins 3 caractères',
            'email.min' => 'Le champ doit contenir au moins 3 caractères',
            'adresse.min' => 'Le champ doit contenir au moins 3 caractères',
            'code_postal.integer' => 'Le champ doit être numérique',
            'code_postal.regex' => 'Votre saisie ne correspond pas au type du champ',
            'ville.min' => 'Le champ doit contenir au moins 3 caractères',
            'fonction.min' => 'Le champ doit contenir au moins 3 caractères',

        ];
    }
}
