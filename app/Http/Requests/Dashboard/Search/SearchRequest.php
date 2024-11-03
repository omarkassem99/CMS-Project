<?php

namespace App\Http\Requests\Dashboard\Search;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'search'=>'required|min:2'
        ];
    }
    public function messages()
    {
        return [
            'search.required'=>'Please Enter Required Search',
            'search.min'=>'Search Text Must be at Least 2 Characters',
        ];
    }
}
