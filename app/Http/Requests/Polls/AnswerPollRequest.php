<?php

namespace App\Http\Requests\Polls;

use Illuminate\Foundation\Http\FormRequest;

class AnswerPollRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'answer' => ['boolean'],
        ];
    }
}
