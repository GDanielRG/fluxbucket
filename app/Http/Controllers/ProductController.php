<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Inertia::render('Home', [
            'products' =>  Product::all(),
            'orders' =>  Auth::user()->customer?->orders()->with('product')->get(),
            'product' =>  $product,
        ]);
    }
}
