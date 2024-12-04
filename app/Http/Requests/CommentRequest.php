<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => 'required|string|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le champ Comment est obligatoire.',
            'content.min' => 'Le commentaire doit faire au moins 3 caractères.'
        ];
    }
}
