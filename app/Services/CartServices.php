<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartServices
{
    public function getCartProductPrice(Cart $card, int $productId): array
    {
        $product = Product::with('offer')->find($productId);
        $offer = $product->offer;
        $price = $product->price;
        if (! is_null($offer)) {
            $hasOfferItem = $card->items()
                ->where('product_id', $product->id)
                ->where('is_offer', false)
                ->exists();

            $hasOfferPrice = $card->items()
                ->where('product_id', $product->id)
                ->where('is_offer', true)
                ->exists();

            if ($hasOfferItem && ! $hasOfferPrice) {
                $prise = round($product->price - ($product->price * $offer->percentage / 100), 2);

                return [$prise, true];
            } else {
                return [$price, false];
            }
        }

        return [$price, false];
    }

    public function getTotal(Cart $card): array
    {
        $totalItemsSum = $card->items_sum_price / 100;

        $deliveryPrice = match (true) {
            $totalItemsSum >= 90 => 0.0,
            $totalItemsSum >= 50 => 2.95,
            default => 4.95
        };

        $total = round($totalItemsSum + $deliveryPrice, 2);

        return [$deliveryPrice, $total];
    }
}
