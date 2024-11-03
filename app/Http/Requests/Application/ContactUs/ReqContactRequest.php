<?php

namespace App\Http\Requests\Application\ContactUs;

use Illuminate\Foundation\Http\FormRequest;

class ReqContactRequest extends FormRequest
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
            "company"=>'required|string',
            "email"=>'required|email',
            'country_code' => 'required||regex:/^\+[0-9]{1,4}$/',
            "phone"=>'required|numeric|max_digits:15',
            "country"=>'required|string',
            "project_budget"=>'required|numeric',
            "service"=>'required|string',
            "details"=>'required',
        ];
    }
    public function messages()
    {
        return [
            "full_name.required"=>'Please Enter Your Name',
            "full_name.regex"=>'Name Can Only have letters',
            "company.required"=>'Please Enter Company Name',
            "email.required"=>'Please Enter Your Email',
            "email.email"=>'Please Enter Valid Email',
            'country_code.required' => 'Please Enter Country Code',
            'country_code.regex' => 'Country Code Cannot be more that 4 digits and Must start with +',
            "phone.required"=>'Please Enter Your Phone Number',
            "phone.numeric"=>'Phone must Contain Only Numbers',
            "phone.digits"=>"Phone Can't be more than 15 digits",
            "country.required"=>'Please Enter Your Country',
            "project_budget.required"=>'Please Enter Your Budget',
            "project_budget.numeric"=>'Budget Must be Only Numbers',
            "service"=>'Please Enter The Required Service ',
            "details"=>'Please Enter Your Details ',
        ];
    }
}
