<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static $unguarded = true;

    protected $appends = ['formatted_product_price', 'formatted_created_at'];

    protected $dates = ['created_at'];


    /**
     * Relationship
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Getter
     */
    protected function formattedProductPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => '$' . number_format($this->getAttributes()['product_price'] / 100, 2, ".", ",") . ' USD',
        );
    }

    /**
     * Getter
     */
    protected function formattedCreatedAt(): Attribute
    {

        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans(),
        );
    }
}
