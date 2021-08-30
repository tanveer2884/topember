<?php

namespace Tests;

use App\Models\User;

trait WithLoginUser
{
    private function login() 
    {
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
