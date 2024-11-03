<?php

namespace App\Http\Requests\Dashboard\Team;

use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->isMethod('put'))
        {
            $member = Team::findOrFail($this->route('team') );
            
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
            'name'=> 'required|regex:/^[a-zA-Z\s]+$/',
            'position'=> 'required|string',
            'email'=> 'required|email|unique:teams,email,' .  $this->route('team'),
            'country_code' => 'required||regex:/^\+[0-9]{1,4}$/',
            'phone'=> 'required|numeric|max_digits:15|unique:teams,phone,' . $this->route('team'),
            'birth_date'=> 'required|date_format:Y-m-d',
            'gender'=> 'required|in:Male,Female',
            'image'=>(request()->isMethod('put'))? 'nullable|image|mimes:png,jpg,jpeg,gif, bmp, tiff, svg, webp, heic, ico':'required|image|mimes:png,jpg,jpeg,gif, bmp, tiff, svg, webp, heic, ico',
            'hire_date'=> 'required|date_format:Y-m-d',
            'status'=> 'required|in:Active,Inactive,Terminated',
            'salary'=> 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            "name.required"=>'Please Enter Your Name',
            "name.regex"=>'Name Can Only have letters',
            'position.required'=> 'Please Enter The Position',
            "email.required"=>'Please Enter Your Email',
            "email.email"=>'Please Enter Valid Email',
            "email.unique"=>'The Email is Already Registered',
            'country_code.required' => 'Please Enter Country Code',
            'country_code.regex' => 'Country Code Cannot be more that 4 digits and Must start with +',
            "phone.required"=>'Please Enter Your Phone Number',
            "phone.numeric"=>'Phone must Contain Only Numbers',
            "phone.digits"=>"Phone Can't be more than 15 digits",
            "phone.unique"=>'This Number is Already Registered ',
            'birth_date.required' => 'Please Enter Birth Date',
            'birth_date.date_format' => 'Please Enter Valid Format (yyyy-mm-dd)',
            'gender.required' => 'Please Enter The Gender',
            'image.required'=>"Please Enter Member's Image", 
            'image.image'=>'You Can Only upload Image', 
            'hire_date.required' => 'Please Enter Hire Date',
            'hire_date.date_format' => 'Please Enter Valid Format (yyyy-mm-dd)',
            "status.required"=>'Please Enter The Status',
            'salary.required'=>'Please Enter The Salary',
            'salary.numeric'=>'Salary must be Numbers',
        ];
    }
}

