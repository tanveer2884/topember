<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Address;
use Tests\WithLoginUser;
use Tests\Feature\Common\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\Frontend\Account\Address\CreateEditAddress;

class MyAddressesTest extends TestCase
{
    use WithLoginUser;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_addresses()
    {
        $this->login();

        $address = Address::create([
            'nickname' => 'John Smith',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'user_id' => Auth::id(),
            'email' => 'jhon@test.com',
            'phone' => '1234567890',
            'address' => '1234567890',
            'address2' => '1234567890',
            'city' => 'New York',
            'country' => 'USA',
            'state' => 'NY',
            'zipCode' => '10001',
        ]);

        Livewire::test(CreateEditAddress::class)
            ->set('nickname', $address->nickname)
            ->set('user_id',Auth::id())
            ->set('first_name', $address->first_name)
            ->set('last_name',$address->last_name)
            ->set('email',$address->email)
            ->set('phone',$address->phone)
            ->call('submit')
            ->assertSee('email');
    }

   
}
