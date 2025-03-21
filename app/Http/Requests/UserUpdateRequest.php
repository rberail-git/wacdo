<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'firstname' => ['string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['confirmed']
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Le champ Nom doit contenir 255 caractères maximum',
            'name.required' => 'Le champ Nom est obligatoire',
            'firstname.max' => 'Le champ Prénom doit contenir 255 caractères maximum',
            'firstname.required' => 'Le champ Prénom est obligatoire',
            'email.required' => 'Le champ Adresse Mail est obligatoire',
            'email.email' => "Le champ Adresse Mail n'est pas valide",
            'password.confirmed' => 'Les passwords doivent correspondre',



        ];
    }
}
