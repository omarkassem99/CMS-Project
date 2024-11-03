<?php

namespace App\Http\Resources\Application\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->country_code . $this->phone,
            'Profile_Picture'=>config('app.url') . '/'. $this->image,
            
        ];
    }
}
