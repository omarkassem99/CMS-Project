<?php

namespace App\Http\Requests\Application\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email"=> 'nullable|required_without:phone|email',
            "phone"=> 'nullable|required_without:email|numeric',
            "password"=>'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required_without' => 'Please enter either email or phone.',
            'phone.required_without' => 'Please enter either phone or email.',
            "password.required"=>'Please Enter Your Password',
            "password"=>'Password Must be at Least 8 Digits',
        ];
    }
}

