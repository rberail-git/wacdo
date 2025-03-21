<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'adresse' => ['required'],
            'code_postal' => ['required', 'regex:/^[0-9]{5}$/'],
            'ville' => ['required'],

        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Le champ doit contenir au moins 3 caractères',
            'name.required' => 'Le champ Nom est obligatoire',
            'adresse.required' => 'Le champ Adresse est obligatoire',
            'code_postal.required' => 'Le champ Code Postal est obligatoire',
            'code_postal.regex' => "Le format du Code Postal n'est pas valide",
            'ville.required' => 'Le champ ville est obligatoire',


        ];
    }

}
