<?php

namespace App\Http\Requests\Application\User;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'country_code' => 'required||regex:/^\+[0-9]{1,4}$/',
            'phone' => 'required|numeric|digits:10||unique:users,phone',
            'password' => 'required|confirmed|min:8',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif, bmp, tiff, svg, webp, heic, ico'
        ];
    }

    public function messages()
    {
        return [
            "name.required" => 'Please Enter Your Name',
            "name.regex" => 'Name Can Only Include Letters',
            "email.required" => 'Please Enter Your Email',
            "email.email" => 'Please Enter Valid Email',
            "email.unique" => 'The Email is Already Registered',
            'country_code.required' => 'Please Enter Country Code',
            'country_code.regex' => 'Country Code Cannot be more that 4 digits and Must start with +',
            "phone.required" => 'Please Enter Your Phone Number',
            "phone.numeric" => 'Phone must Contain Only Numbers',
            "phone.digits" => 'Phone Must be 10 Digits',
            "phone.unique" => 'This Number is Already Registered ',
            'password.required' => 'Please Enter Your Password',
            'password.min' => 'Password Must be at Least 8 Digits',
            'image.required' => 'Please Enter Your Image',
            'image.image' => 'You Can Only upload Image',
        ];
    }
}

