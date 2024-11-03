<?php

namespace App\Http\Requests\Application\User;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ];
    }
    public function messages()
    {
        return [
            "current_password.required"=>'Please Enter Your Current Password',
            "new_password.required"=>'Please Enter Your New Password',
            "new_password.min"=>'Password Must be at Least 8 Digits',
        ];
    }
}

