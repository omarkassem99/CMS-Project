<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->isMethod('put'))
        {
            $member = Product::findOrFail($this->route('product') );
            
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
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => (request()->isMethod('put')) ? 'nullable|array|min:1' : 'required|array|min:1',
            'image.*' => 'file|image|mimes:jpeg,png,jpg,gif, bmp, tiff, svg, webp, heic, ico',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime'
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>'Please Enter Product Name',
            "desc.required"=>'Please Enter Description',
            'category_id.required' => 'Please Enter Category ID',
            'category_id.exists' => 'This Category Does not Exist',
            'image.required'=>'Please Enter Product Image', 
            'image.*.image'=>'You Can Only upload Image', 

        ];
    }
}
