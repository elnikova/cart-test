<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        $basket = [
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Cart::query()->insert($basket);
    }
}
