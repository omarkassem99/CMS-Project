<?php

namespace App\Http\Resources\Dashboard\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            "Project Name"=>$this->name,
            "Project Description"=>$this->desc,
            "Client Name"=>$this->client ? $this->client->name : 'Category Not Found' ,
            "Project Status"=>$this->status,
        ];
    }
}
