<?php

namespace Topdot\Product\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\WithUniqueId;
use Topdot\Product\Models\Attribute;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Traits\InteractsWithRequests;
use Topdot\Product\Repositories\AttributeRepository;

class AttributeTableComponent extends Component
{
    protected string $paginationTheme = 'bootstrap';

    use HasSorting,
        WithUniqueId,
        WithPagination,
        InteractsWithRequests,
        ResetsPagination;

    public string $search = '';

    public function render()
    {
        return view('product::livewire.attribute-table-component',[
            'attributes' => $this->_getAttributes()
        ]);
    }

    public function delete(Attribute $attribute, AttributeRepository $attributeRepository)
    {
        try {
            $attributeRepository->delete($attribute);
            $this->emit('alert-success','Attribute Deleted Successfully');
        }catch (\Exception $exception){
            $this->emit('alert-danger',$exception->getMessage());
        }
    }

    private function _getAttributes()
    {
        return (new AttributeRepository)->get(
            $this->getRequest($this->getAttributes()),
            10,
            $this->sortOrder,
            $this->orderBy
        );
    }

    private function getAttributes(): array
    {
        return [
            'search' => $this->search
        ];
    }
}
