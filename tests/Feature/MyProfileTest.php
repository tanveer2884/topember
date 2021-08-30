<?php

namespace Tests\Feature;

use App\Http\Livewire\Frontend\Account\MyAccountForm;
use App\Http\Livewire\Frontend\Auth\LoginController;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class MyProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_my_profile()
    {
        $user = $this->login();

        Livewire::test(MyAccountForm::class)
            ->set('name', $user->name)
            ->set('first_name', $user->first_name)
            ->set('last_name',$user->last_name)
            ->call('register')
            ->assertSee('email');
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
        return $user;
    }
}
