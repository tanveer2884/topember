<?php

namespace Topdot\Menu\Http\Livewire;

use Livewire\Component;
use Topdot\Menu\Models\Menu;
use Topdot\Menu\Models\MenuItem;

class CreateEditMenuItem extends Component
{
    public ?MenuItem $menuItem = null;
    public Menu $menu;
    public $title;
    public $link;
    public $icon;
    public $order;
    public $parentId;

    public $listeners = [
        'edit-item' => 'editItem'
    ];

    public function mount(Menu $menu, $order=0, $parentId=null)
    {
        $this->menu = $menu;
        $this->order = $order;
        $this->parentId = $parentId;
        $this->initializeFields();
    }

    public function render()
    {
        return view('menu::livewire.create-edit-menu-item');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|max:191',
            'link' => 'required|max:191',
        ]);

        if( $this->menuItem ){
            $this->menuItem->update([
                'title' => $this->title,
                'link' => $this->link,
                // 'order' => $this->order,
                // 'parent_id' => $this->parentId
            ]);
        }

        if ( ! $this->menuItem ){
            MenuItem::create([
                'menu_id' => $this->menu->id,
                'title' => $this->title,
                'link' => $this->link,
                'order' => $this->order,
                'parent_id' => $this->parentId
            ]);
        }

        $this->emit('alert-success','Menu Item Saved');
        $this->emit('items-updated');
        $this->initializeFields();
    }

    public function editItem(MenuItem $menuItem)
    {
        $this->title = $menuItem->title;
        $this->link = $menuItem->link;
        $this->icon = $menuItem->icon;

        $this->order = $menuItem->order;
        $this->parentId = $menuItem->parent_id;
        
        $this->menuItem = $menuItem;
    }

    public function initializeFields()
    {
        $this->title = '';
        $this->link = '';
        $this->icon = '';
        $this->menuItem = null;
    }
}
