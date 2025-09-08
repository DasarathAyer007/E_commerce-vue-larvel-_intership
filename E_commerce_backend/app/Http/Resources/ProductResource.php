<?php

namespace App\Http\Resources;

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
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            //'image'=>$this->when($this->image_path, asset('storage/' . $this->image_path)),
            'image'=>$this->image_path,
            'quantity'=>$this->quantity,
            'price'=>$this->price,
            'category'=>$this->category->name,
            'category_id'=>$this->category->id,
            'user'=>$this->user->name
        ];
    }
}
