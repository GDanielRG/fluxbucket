<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_product_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('products.show', ['product' => $product->id]));

        $response->assertStatus(200);
    }

    public function test_order_can_be_created()
    {
        $this->assertCount(0, Order::all());

        $product = Product::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('orders.store'), [
            'product_id' => $product->id,
            'total' => $product->getAttributes()['price'],
        ]);

        $this->assertCount(1, Order::all());
        $this->assertCount(1, $user->refresh()->customer->orders);
    }

    public function test_order_cant_be_created_when_total_mismatches()
    {
        $this->assertCount(0, Order::all());

        $product = Product::factory()->create();

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('orders.store'), [
            'product_id' => $product->id,
            'total' => $product->getAttributes()['price'] + 2,
        ]);

        $this->assertCount(0, Order::all());
    }
}
