<?php

namespace App\Livewire\Traits;

use Illuminate\Support\Facades\Auth;

trait Authenticated
{
    public function bootAuthenticated(): void
    {
        abort_if(! Auth::check() && ! Auth::guard('admin')->check(), 401);
    }
}
