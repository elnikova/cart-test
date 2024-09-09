<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offer = [
            'product_id' => 1,
            'description' => 'Buy one Red Widget, get the second half price.',
            'percentage' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Offer::query()->insert($offer);
    }
}
