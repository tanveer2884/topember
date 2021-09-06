<?php

namespace Topdot\Menu\Http\Livewire;

use Livewire\Component;
use Topdot\Menu\Models\Menu;

class MenuTableComponent extends Component
{
    public $search;
    
    protected $listeners = [
        'records-updated' => 'render',
        'delete'
    ];

    public function render()
    {
        return view('menu::livewire.menu-table-component',[
            'menus' => $this->getMenuList()
        ]);
    }

    private function getMenuList()
    {
        $query = Menu::query();

        if ( $this->search ){
            $query->where('name','LIKe',"%{$this->search}%");
        }

        return $query->paginate(50);
    }


    public function delete(Menu $menu)
    {
        $menu->items()->delete();
        $menu->delete();
        $this->emit('alert-success','Menu Deleted');
        $this->emit('records-updated');
    }
}
