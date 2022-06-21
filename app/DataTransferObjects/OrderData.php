<?php

namespace App\DataTransferObjects;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class OrderData extends DataTransferObject
{
    public Product $product;

    public int $total;

    public static function fromRequest(Request $request): OrderData
    {
        return new self([
            'product' => Product::findOrFail($request->input('product_id')),
            'total' => $request->input('total'),
        ]);
    }
}
