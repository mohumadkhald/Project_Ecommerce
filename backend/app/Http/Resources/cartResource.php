<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class cartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // dd($this);
        $product = $this->product;
        // dd($this->product);
        $product->image_path = asset('storage/' . $product->image);
        $product2 = new productResource($product);
        $product2->quantity = $this->quantity;
        // $product2->purchase_id = $this->id;
        return [
            'product' => $product2,
            'purchased_product_id' => $this->id
        ];
    }
}
