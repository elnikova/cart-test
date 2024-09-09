<?php

namespace App\Http\Resources;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin CartItem */
class CartItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cart_id' => $this->cart_id,
            'product_id' => $this->product_id,
            'price' => $this->price,
            'is_offer' => $this->is_offer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'product' => ProductsResource::make($this->whenLoaded('product')),
        ];
    }
}
