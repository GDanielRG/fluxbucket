<?php

namespace App\Actions;

use App\DataTransferObjects\OrderData;
use App\Exceptions\TotalDoesNotMatchException;

class CheckOrderPriceAction
{
    public function __invoke(OrderData $orderData): bool
    {
        if ($orderData->product->getAttributes()['price'] != $orderData->total) {
            throw new TotalDoesNotMatchException();
            return false;
        }

        return true;
    }
}
