<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\Frontend\Auth\LoginController;
use Tests\WithLoginUser;

class UserAccountTest extends TestCase
{
    use WithLoginUser;

    /** @test */
    public function check_if_login_user_can_see_my_account_page()
    {
        $this->login();

        $response = $this->get('/my-account');
        $response->assertStatus(200);
    }


    /** @test */
    public function check_if_guest_user_cant_see_my_account_page()
    {
        $response = $this->get('/my-account');
        $response->assertStatus(302);
    }

    /** @test */
    public function check_if_user_can_login()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678')
        ]);

        Livewire::test(LoginController::class)
            ->set('username', $user->email)
            ->set('password',12345678)
            ->call('login')
            ->assertRedirect('/my-account');
    }

    /** @test */
    public function check_if_user_cant_login_with_invalid_password()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678')
        ]);

        Livewire::test(LoginController::class)
            ->set('username', $user->email)
            ->set('password',1234567)
            ->call('login')
            ->assertHasErrors('username');
    }
}
