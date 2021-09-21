<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Tests\WithLoginUser;
use Topdot\Order\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\Frontend\Order\OrderListing;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyOrdersTest extends TestCase
{
    use WithLoginUser;
    
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
        $order->tracking_number = 'test tracking number';
        $order->cart = '';
        $order->status = 1;
        $order->save();

        Livewire::test(OrderListing::class)
            ->call('render')
            ->assertSee('test tracking number');
    }
}
