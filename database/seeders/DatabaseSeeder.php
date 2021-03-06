<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->count(10)
            ->create();

        User::factory()
            ->create(['email' => "hello@fluxbucket.com"]);
    }
}
