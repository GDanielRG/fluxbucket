<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static $unguarded = true;

    protected $appends = ['formatted_price'];

    /**
     * Relationship
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Price getter and setter
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    /**
     * Getter
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => '$' . number_format($this->getAttributes()['price'] / 100, 2, ".", ",") . ' USD',
        );
    }
}
