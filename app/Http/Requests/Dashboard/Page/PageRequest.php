<?php

namespace App\Http\Requests\Dashboard\Page;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->isMethod('put'))
        {
            $member = Page::findOrFail($this->route('id') );
            
            return $member ? true : false;

        }
        else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|unique:pages,slug,' . $this->route('id'),
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please Enter Page Title',
            'slug.required' => 'Please Enter Page Slug',
            'slug.unique' => 'Page Slug is Already Taken',
            'content.required' => 'Please Enter Page Content',
        ];
    }
}
