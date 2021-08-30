<?php

namespace Tests\Feature;

use App\Http\Livewire\Frontend\Order\OrderListing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;
use Topdot\Order\Models\Order;

class MyOrdersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_orders_listing()
    {
        $this->login();

        $order =  new Order();
        $order->user_id = 1;
        $order->order_id = 1;
        $order->coupon_id = 1;
        $order->subtotal = 1;
        $order->discount = 1;
        $order->shipping = 1;
        $order->tax = 1;
        $order->total = 1;
        $order->shipping_name = 1;
        $order->shipping_address = 1;
        $order->shipping_address2 = 1;
        $order->shipping_city = 1;
        $order->shipping_state = 1;
        $order->shipping_email = 1;
        $order->shipping_phone = 1;
        $order->shipping_zipCode = 1;
        $order->billing_name = 1;
        $order->billing_address = 1;
        $order->billing_address2 = 1;
        $order->billing_city = 1;
        $order->billing_state = 1;
        $order->billing_email = 1;
        $order->billing_phone = 1;
        $order->billing_zipCode = 1;
        $order->is_billing_same_as_shipping = 1;
        $order->payment_info_name = 1;
        $order->payment_info_card_number = 1;
        $order->payment_info_expiry = 1;
        $order->payment_info_card_type = 1;
        $order->payment_profile_id = 1;
        $order->tracking_number = 1;
        $order->cart = '';
        $order->status = 1;
       $order->save();

        Livewire::test(OrderListing::class)
            ->call('render')
            ->assertSee('user_id');
    }

    private function login() {

        $user = User::create([
            'name' => 'John Smith',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'jhon@test.com',
            'password' => bcrypt('12345678')
        ]);

        $this->actingAs($user);

    }
}
