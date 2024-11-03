<?php

namespace App\Http\Resources\Application\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID'=>$this->id,
            "Full_Name" => $this->full_name,
            "Email" => $this->email,
            "Subject" => $this->subject,
            "Project_Details" => $this->details
        ];
    }
}
