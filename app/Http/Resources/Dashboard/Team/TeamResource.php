<?php

namespace App\Http\Resources\Dashboard\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'Name'=>$this->name,
            'Position'=>$this->position,
            'Email'=>$this->email,
            'Phone'=> $this->country_code . $this->phone,
            'Birth_Date'=>$this->birth_date,
            'Gender'=>$this->gender,
            'Personal_Image'=>config('app.url') . '/'. $this->image,
            'Hire_Date'=>$this->hire_date,
            'Status'=>$this->status,
            'Salary'=>$this->salary
        ];
    }
}
