<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property mixed $price
 */
class Product extends Model
{
    protected $guarded = ['id'];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
        );
    }

    public function offer(): HasOne
    {
        return $this->hasOne(Offer::class);
    }
}
