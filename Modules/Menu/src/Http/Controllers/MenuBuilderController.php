<?php

namespace Topdot\Menu\Http\Controllers;

use Topdot\Menu\Models\Menu;

class MenuBuilderController
{
    public function __invoke(Menu $menu)
    {
        return view('menu::builder',compact('menu'));
    }
}
