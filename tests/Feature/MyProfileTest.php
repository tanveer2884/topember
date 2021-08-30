<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Tests\WithLoginUser;
use App\Http\Livewire\Frontend\Auth\LoginController;
use App\Http\Livewire\Frontend\Account\MyAccountForm;

class MyProfileTest extends TestCase
{
    use WithLoginUser;
    
    /** @test */
    public function update_my_profile()
    {
        $user = $this->login();

        Livewire::test(MyAccountForm::class)
            ->set('name', $user->name)
            ->set('first_name', $user->first_name)
            ->set('last_name',$user->last_name)
            ->call('register')
            ->assertSee('email');
    }
}
