<?php

namespace Topdot\Core\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Core\Models\Manufacturer;
use Topdot\Core\Repositories\ManufactureRepository;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\InteractsWithRequests;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Traits\WithUniqueId;

class ManufactureTableComponent extends Component
{
    use WithPagination,
        HasSorting,
        WithUniqueId,
        InteractsWithRequests,
        ResetsPagination;

    protected $listeners = [
        'delete' => 'delete'
    ];

    public $search;

    public function mount()
    {
        $this->search = '';
    }

    public function render()
    {
        return view('core::livewire.manufacture-table-component',[
            'manufactures' => $this->getManufactures()
        ]);
    }

    public function delete(Manufacturer $manufacturer)
    {
        (new ManufactureRepository())->delete($manufacturer);
        $this->emit('alert-success','Manufacture Deleted Successfully.');
    }

    private function getManufactures()
    {
        return (new ManufactureRepository())->get(
            $this->getSearchAttributes(),
            50,
            $this->sortOrder,
            $this->orderBy
        );
    }

    private function getSearchAttributes()
    {
        return $this->getRequest([
            'search' => $this->search
        ]);
    }
}
