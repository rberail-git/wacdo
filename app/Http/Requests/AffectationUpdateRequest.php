<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffectationUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer','exists:users,id'],
            'restaurants_id_multi' => ['array'],
            'restaurants_id' => ['nullable','integer','exists:restaurants,id'],
            'fonctions_id' => ['nullable','integer','exists:fonctions,id'],
            'date_debut' => ['required','date'],
            'date_fin' => ['nullable','date','after_or_equal:date_debut'],
        ];
    }
}
