<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FormPollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'context' => 'required|string',
            'analysis' => 'required|string',
            'quote' => 'required|string|max:500',
            'author' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'published_at' => 'required|date',
            'is_intox' => 'boolean|required',
        ];
    }

    public function messages(): array {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre est trop long',
            'context.required' => 'Le contexte est obligatoire.',
            'analysis.required' => 'L\'analyse est obligatoire.',
            'quote.required' => 'La quote est obligatoire.',
            'quote.max' => 'La quote est trop longue',
            'author.required' => 'L\'auteur est obligatoire.',
            'author.max' => 'L\'auteur est trop long.',
            'slug.required' => 'Le slug est obligatoire.',
            'published_at.required' => 'La date de publication est obligatoire.',
            'is_intox.required' => 'L\'intox est obligatoire.',
        ];
    }

    protected function prepareForValidation(): void {
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title'))
        ]);
    }
}
