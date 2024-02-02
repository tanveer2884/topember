<?php

namespace App\Livewire\Admin\Cms\Menu;

use App\Models\Menu;
use Illuminate\Contracts\View\View;

class MenuBuilderController extends MenuAbstract
{
    public Menu $menu;

    public function render(): View
    {
        return $this->view('livewire.admin.cms.menu.builder');
    }
}
