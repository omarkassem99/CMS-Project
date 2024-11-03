<?php

namespace App\Http\Resources\Dashboard\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'Client Name'=>$this->name,
            'Phone'=> $this->country_code . $this->phone,
            'Image'=>config('app.url') . '/'. $this->image,
            'Date Of Purchase'=>$this->date_of_purchase,
            'Project'=>$this->projects->pluck('name'),
            'Status'=>$this->status,
            'Client Budget'=>$this->client_budget,
            
        ];
    }
}
