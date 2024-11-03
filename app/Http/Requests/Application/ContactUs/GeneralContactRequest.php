<?php

namespace App\Http\Requests\Application\ContactUs;

use Illuminate\Foundation\Http\FormRequest;

class GeneralContactRequest extends FormRequest
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
            "full_name"=>'required|regex:/^[a-zA-Z\s]+$/',
            "email"=>'required|email',
            "subject"=>'required|string',
            "details"=>'required',
        ];
    }

    public function messages()
    {
        return [
           'full_name.required'=>'Please Enter Your Name',
           'full_name.regex'=>'Name Can Only have letters',
           'email.required'=>'Please Enter Your Email',
           'email.email'=>'Please Enter Valid Email',
           'subject'=>'Please Enter The Subject',
           'details'=>'Please Enter The Details',
        ];
    }
}