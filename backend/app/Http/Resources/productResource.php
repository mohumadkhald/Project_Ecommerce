<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'image_path' => $this->image_path,
        'quantity' => $this->when($this->hidden === null, $this->quantity),
        'price' => $this->price,
        'seller' => $this->user->name,
        'rating' => $this->rating
        ];
    }
}
