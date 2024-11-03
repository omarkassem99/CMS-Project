<?php

namespace App\Http\Resources\Dashboard\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'Product_Name' => $this->name,
            'Description' => $this->desc,
            'Video'=>$this->video,
            'Category'=>$this->category ? $this->category->name : 'Category Not Found', 
            'images' => $this->images->map(function ($image) {
                return[
                    'id' =>$image->id,
                    'path'=> config('app.url') . $image->image , 
                ]; 
            }),
            
        ];
    }
}
