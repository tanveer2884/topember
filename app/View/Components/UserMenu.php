<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class UserMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view($this->menu());
    }

    public function menu()
    {
        return "components.admin-menu";
    }

    public function isActive($route)
    {
        return isActive($route);
    }
}
