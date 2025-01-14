<?php

namespace App\Http\Resources\Dashboard\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'Category_Name' => $this->name,
            'Description' => $this->desc,
        ];
    }
}
