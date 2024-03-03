<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookPutRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:100',
            'price' => 'required|numeric|min:1|max:999999',
            'author_ids' => 'required|array',
            'author_ids.*' => 'required|integer|exists:authors,id',
        ];
    }
}
