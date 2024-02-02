<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutController extends Component
{
    public bool $isSideBar;

    public function render(): View
    {
        return view('admin.auth.logout-controller');
    }

    /**
     * End admin session and logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        session()->regenerate();

        return to_route('login');
        //return to_route('admin.login');
    }
}
