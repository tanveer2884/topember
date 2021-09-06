<?php

namespace Topdot\Menu\Http\Controllers;

class MenuController
{
    public function __invoke()
    {
        return view('menu::create');
    }
}
