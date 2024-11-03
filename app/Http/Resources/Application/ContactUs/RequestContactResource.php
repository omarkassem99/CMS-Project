<?php

namespace App\Http\Resources\Application\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID'=> $this->id,
            "Full_Name"=>$this->full_name,
            "Company"=>$this->company,
            "Email"=>$this->email,
            "Phone_Number"=> $this->country_code . $this->phone,
            "Country"=>$this->country,
            "Project_Budget"=>$this->project_budget,
            "Service_Required"=>$this->service,
            "Project_Details"=>$this->details

        ];
    }
}
