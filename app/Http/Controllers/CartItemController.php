<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Services\CartServices;
use Illuminate\Http\JsonResponse;
use Throwable;

class CartItemController extends Controller
{
    public function store(CartItemRequest $request): CartItemResource
    {
        $cart = $request->user()->cart;
        [$price, $isOffer] = (new CartServices)->getCartProductPrice($request->user()->cart, $request->product_id);

        $cartItem = $cart->items()->create([
            'price' => $price,
            'is_offer' => $isOffer,
            'product_id' => $request->product_id,
        ]);

        return CartItemResource::make($cartItem);
    }

    /**
     * @throws Throwable
     */
    public function destroy(CartItem $cartItem): JsonResponse
    {
        $cartItem->deleteOrFail();

        return response()->json();
    }
}
