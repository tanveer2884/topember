<?php

namespace Topdot\Menu\Http\Livewire;

use Livewire\Component;
use Topdot\Menu\Models\Menu;
use Topdot\Menu\Models\MenuItem;
use Topdot\Order\Models\Order;

class MenuBuilder extends Component
{
    public Menu $menu;

    protected $listeners = [
        'items-updated' => 'render',
        'updateSorting',
        'delete-item' => 'deleteItem'
    ];

    public function mount(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function render()
    {
        return view('menu::livewire.menu-builder',[
            'items' => $this->getItems()
        ]);
    }

    public function updateSorting($data)
    {
        $reorderedItems = $this->flattenArray($data);

        foreach ($reorderedItems as $item) {
            MenuItem::find($item['id'])->update([
                'order' => $item['order'],
                'parent_id' => $item['parent_id']
            ]);
        }

        $this->emit('alert-success','List Updated');
    }


    public function getItems()
    {
        return $this->menu->items()->orderBy('order')->doesntHave('parent')->get();
    }

    private function flattenArray($data,$parent=null,$order=0)
    {
        $items = [];
        foreach ($data as $item) {
            array_push($items,$this->buildItem($item,$order,$parent));
            if ( isset($item['children']) && !empty($item['children'])){
                $items = array_merge($items,$this->flattenArray($item['children'],$item['id']));
            }
            $order++;
        }

        return $items;
    }

    private function buildItem($item,$order,$parent=null)
    {
        return [
            'id' => $item['id'],
            'order' => $order,
            'parent_id' => $parent == $item['id'] ? null : $parent
        ];
    }

    public function deleteItem(MenuItem $menuItem)
    {
        $menuItem->delete();
        $this->emit('alert-success','Menu Item Deleted');
    }
}
