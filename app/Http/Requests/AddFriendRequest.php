<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddFriendRequest extends FormRequest
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
            'friend_id' => [
                'required',
                'exists:users,friend_id', // Vérifie que le friend_id existe dans la colonne `friend_id` de la table users
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'friend_id.exists' => 'Aucun utilisateur n\'a été trouvé',
        ];
    }
}
