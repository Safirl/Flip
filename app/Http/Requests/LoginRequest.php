<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $isRegister = $this->route()->getName() === 'auth.register.create';
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        if ($isRegister) {
            $rules['name'] = ['required', 'string', 'max:255', 'min:3'];
            $rules['email'] = 'unique:users,email';
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'name.min' => 'Le nom doit faire au moins 3 caractères.',
            'name.required' => 'Le nom est obligatoire pour l\'inscription.',
        ];
    }
}
