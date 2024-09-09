<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Services\CartServices;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __invoke(Request $request): CartResource
    {
        $card = $request->user()->cart
            ->load('items.product')
            ->loadSum('items', 'price');

        [$deliveryPrice, $total] = (new CartServices)->getTotal($card);

        return CartResource::make(
            $card
        )->additional(['data' => [
            'delivery_price' => $deliveryPrice,
            'total' => $total,
        ]]);
    }
}
