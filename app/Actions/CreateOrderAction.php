<?php

namespace App\Actions;

use App\Models\Order;
use App\DataTransferObjects\OrderData;
use Illuminate\Support\Facades\Auth;

class CreateOrderAction
{
    private FindOrCreateCustomerAccount $findOrCreateCustomerAccount;

    private CheckOrderPriceAction $checkOrderPriceAction;

    public function __construct(FindOrCreateCustomerAccount $findOrCreateCustomerAccount, CheckOrderPriceAction $checkOrderPriceAction)
    {
        $this->findOrCreateCustomerAccount = $findOrCreateCustomerAccount;
        $this->checkOrderPriceAction = $checkOrderPriceAction;
    }

    public function __invoke(OrderData $orderData): Order
    {
        ($this->checkOrderPriceAction)($orderData);

        $customer = ($this->findOrCreateCustomerAccount)(Auth::user());

        $order = Order::create([
            'product_id' => $orderData->product->id,
            'customer_id' => $customer->id,
            'product_price' => $orderData->product->getAttributes()['price'],
        ]);

        return $order;
    }
}
