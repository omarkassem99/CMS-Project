<?php

namespace App\Http\Requests\Dashboard\Client;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (request()->isMethod('put'))
        {
            $client = Client::findOrFail($this->route('client'));
            return $client ? true : false;
        }
        else
        {
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
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'country_code' => 'required||regex:/^\+[0-9]{1,4}$/',
            'phone' => 'required|numeric|max_digits:15|unique:clients,phone,' . $this->route('client'),
            'image' => (request()->isMethod('put')) ? 'nullable|image|mimes:png,jpg,jpeg,gif, bmp, tiff, svg, webp, heic, ico' : 'required|image|mimes:png,jpg,jpeg,gif, bmp, tiff, svg, webp, heic, ico',
            'date_of_purchase' => 'required|date_format:Y-m-d',
            'status' => 'required|in:Pending,Done',
            'client_budget' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>'Please Enter Category Name',
            "name.regex"=>'Name Can Only have letters',
            'country_code.required' => 'Please Enter Country Code',
            'country_code.regex' => 'Country Code Cannot be more that 4 digits and Must start with +',
            "phone.required"=>'Please Enter Your Phone Number',
            "phone.numeric"=>'Phone must Contain Only Numbers',
            "phone.digits"=>"Phone Can't be more than 15 digits",
            "phone.unique"=>'This Number is Already Registered',
            'image.required'=>"Please Enter Member's Image", 
            'image.image'=>'You Can Only upload Image', 
            'date_of_purchase.required' => 'Please Enter Purchase Date',
            'date_of_purchase.date_format' => 'Please Enter Valid Format (yyyy-mm-dd)',
            'status'=>'Please Enter The Status of The CLient',
            'client_budget.required' => 'Please Enter The Budget',
            'client_budget.numeric' => 'Budget Must be Numbers'

        ];
    }

   
}