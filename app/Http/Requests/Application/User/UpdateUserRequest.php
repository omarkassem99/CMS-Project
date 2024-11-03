<?php

namespace App\Http\Requests\Application\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users,email,' . Auth::id(), 
            'country_code' => 'required||regex:/^\+[0-9]{1,4}$/',
            'phone' => 'required|numeric|unique:users,phone,'. Auth::id(),
            'image'=>'nullable|image|mimes:png,jpg,jpeg,gif, bmp, tiff, svg, webp, heic, ico'
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>'Please Enter Your Name',
            "name.regex"=>'Name Can Only have letters',
            "email.required"=>'Please Enter Your Email',
            "email.email"=>'Please Enter Valid Email',
            "email.unique"=>'The Email is Already Registered',
            'country_code.required' => 'Please Enter Country Code',
            'country_code.regex' => 'Country Code Cannot be more that 4 digits and Must start with +',
            "phone.required"=>'Please Enter Your Phone Number',
            "phone.numeric"=>'Phone must Contain Only Numbers',
            "phone.digits"=>'Phone Must be 10 Digits',
            'image.image'=>'You Can Only upload Image', 
        ];
    }
}
