<?php

namespace App\Actions;

use App\Models\Customer;
use App\Models\User;

class FindOrCreateCustomerAccount
{
    public function __invoke(User $user): Customer
    {
        if ($user->customer) {
            return $user->customer;
        }

        $customer = Customer::create([
            'user_id' => $user->id,
        ]);

        return $customer;
    }
}
