<?php

namespace App\Http\Controllers;

use App\Actions\CreateOrderAction;
use App\DataTransferObjects\OrderData;
use App\Exceptions\TotalDoesNotMatchException;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request, CreateOrderAction $createOrderAction)
    {
        $orderData = OrderData::fromRequest($request);

        try {
            ($createOrderAction)($orderData);
        } catch (TotalDoesNotMatchException $e) {
            $request->session()->flash('flash', ['banner' => 'The price of the product has changed.', 'bannerStyle' => 'danger']);
            return back();
        } catch (\Exception $e) {
            $request->session()->flash('flash', ['banner' => 'Something went wrong.', 'bannerStyle' => 'danger']);
            return back();
        }

        $request->session()->flash('flash', [
            'banner' => 'Order created successfully! 🍽️ BTW we like ' . Auth::user()->favorite_food . ' too! 😋'
        ]);

        return redirect()->route('home');
    }
}
