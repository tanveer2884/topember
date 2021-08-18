<?php

namespace App\Http\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutButton extends Component
{
    public function render()
    {
        return view('livewire.frontend.auth.logout-button');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
