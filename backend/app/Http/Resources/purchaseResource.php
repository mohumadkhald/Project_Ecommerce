<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\cartResource;
use App\Models\PurchasedProduct;

class purchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
                    // $test=(cartResource::collection($this->whenLoaded('purchasedProducts')));
                    // dd($this->id);
                    // $allpurchased = PurchasedProduct::where('purchase_id','=',$this->id);
        return [
            'id'=>$this->id,
            'state'=>$this->state,
            'created_at'=>$this->created_at,
            // 'products' => $allpurchased,
            'products' => cartResource::collection($this->whenLoaded('purchasedProducts')),
        ];
    }
}
