<?php

namespace Tests\Feature;

use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CartTest extends TestCase
{
    #[DataProvider('productsAndTotal')]
    public function test_cart_total(array $productIds, float $total): void
    {
        $user = User::first();
        $this->actingAs($user);

        foreach ($productIds as $productId) {
            $this->postJson('api/cart-items', [
                'product_id' => $productId,
            ]);
        }

        $response = $this->getJson('api/cart');

        $this->assertEquals($response->json('data')['total'], $total, 'Total: '.$total.' Cart: '.$response->json('data')['total']);

    }

    public static function productsAndTotal(): array
    {
        return [
            ['productIds' => [2, 3], 'total' => 37.85],
            ['productIds' => [1, 1], 'total' => 54.38],
            ['productIds' => [1, 2], 'total' => 60.85],
            ['productIds' => [3, 3, 1, 1, 1], 'total' => 98.28],
        ];
    }
}
