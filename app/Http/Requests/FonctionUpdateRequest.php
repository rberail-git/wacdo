<?php

namespace App\Http\Requests;

use App\Models\Fonctions;
use Illuminate\Foundation\Http\FormRequest;

class FonctionUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255','unique:'.Fonctions::class.',name'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.max' => 'Le champ doit contenir maximum 255 caractères',
            'name.unique' => 'Cette fonction existe déjà en base de données',
            'name.required' => 'Ce champ est obligatoire',


        ];
    }
}
