<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class purchaseResource extends JsonResource
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
            'state'=>$this->state,
            'created_at'=>$this->created_at,
            'products' => cartResource::collection($this->whenLoaded('purchasedProducts')),
        ];
    }
}
