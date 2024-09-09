<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Red Widget',
                'code' => 'R01',
                'price' => 3295,
            ],
            [
                'name' => 'Green Widget',
                'code' => 'G01',
                'price' => 2495,
            ],
            [
                'name' => 'Blue Widget',
                'code' => 'B01',
                'price' => 795,
            ],
        ];

        $products = collect($products)
            ->map(fn (array $product) => [...$product, 'created_at' => now(), 'updated_at' => now()])
            ->toArray();

        Product::query()->insert($products);
    }
}
