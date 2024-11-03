<?php

namespace App\Http\Requests\Dashboard\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->isMethod('put'))
        {
            $member = Category::findOrFail($this->route('category') );
            
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
            'name' =>   'required|string',
            'desc' =>   'required|string',
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>'Please Enter Category Name',
            "desc.required"=>'Please Enter Description',
        ];
    }
}

