<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminRequest extends FormRequest
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
                'email' => 'required|email|unique:admins,email,' , 
                'country_code' => 'required||regex:/^\+[0-9]{1,4}$/',
                'phone' => 'required|numeric|unique:admins,phone,',
                'image'=> 'required|image|mimes:png,jpg,jpeg,gif, bmp, tiff, svg, webp, heic, ico',
                'password'=>'required|min:8'
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
            "phone.unique"=>'Number is Already Registered',
            'image.image'=>'You Can Only upload Image',
            'password.required'=>'Please Enter the Password',
            'password.min'=>'Password must be at least 8 digits',
        ];
    }
}
