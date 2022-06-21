<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Home', [
            'products' =>  Product::all(),
            'orders' =>  Auth::user()->customer?->orders()->with('product')->get(),
        ]);
    }
}
