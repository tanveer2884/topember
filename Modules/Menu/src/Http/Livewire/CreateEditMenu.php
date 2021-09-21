<?php

namespace Topdot\Menu\Http\Livewire;

use Livewire\Component;
use Topdot\Menu\Models\Menu;

class CreateEditMenu extends Component
{
    public ?Menu $menu = null;
    public $name;

    public $listeners = [
        'edit-item' => 'editItem'
    ];

    public function mount()
    {
        $this->initializeFields();
    }

    public function render()
    {
        return view('menu::livewire.create-edit-menu');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|max:191|unique:menus,name'. ( $this->menu ? ','.$this->menu->id :'' )
        ]);

        if( $this->menu ){
            $this->menu->update([
                'name' => $this->name
            ]);
        }

        if ( ! $this->menu ){
            Menu::create([
                'name' => $this->name
            ]);
        }

        $this->emit('alert-success','Menu Saved');
        $this->emit('records-updated');
        $this->initializeFields();
    }

    public function editItem(Menu $menu)
    {
        $this->menu = $menu;
        $this->name = $menu->name;
    }

    public function initializeFields()
    {
        $this->name = '';
        $this->menu = null;
    }
}
