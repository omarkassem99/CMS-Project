<?php

namespace App\Http\Requests\Dashboard\Project;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->isMethod('put'))
        {
            $member = Project::findOrFail($this->route('project') );
            
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
            'desc' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:Running,Completed,Pending',
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>'Please Enter Product Name',
            "desc.required"=>'Please Enter Description',
            'client_id.required' => 'Please Enter Client ID',
            'category_id.exists' => 'This Client Does not Exist',
            'status.required'=>'Please Enter Project Status',

        ];
    }
}
