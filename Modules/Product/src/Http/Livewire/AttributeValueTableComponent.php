<?php

namespace Topdot\Product\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\WithUniqueId;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Traits\InteractsWithRequests;
use Topdot\Product\Models\Attribute;
use Topdot\Product\Models\AttributeValue;
use Topdot\Product\Repositories\AttributeValueRepository;

class AttributeValueTableComponent extends Component
{
    protected string $paginationTheme = 'bootstrap';

    use HasSorting,
        WithUniqueId,
        WithPagination,
        InteractsWithRequests,
        ResetsPagination;

    protected $listeners = [
        'values-updated' => 'render'
    ];

    public $attribute;

    public function mount(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    public string $search = '';

    public function render()
    {
        return view('product::livewire.attribute-value-table-component',[
            'attributeValues' => $this->getAttributeValues()
        ]);
    }

    public function delete(AttributeValue $attributeValue, AttributeValueRepository $attributeValueRepository)
    {
        try {
            $attributeValueRepository->delete($attributeValue);
            $this->emit('alert-success','Attribute Deleted Successfully');
        }catch (\Exception $exception){
            $this->emit('alert-danger',$exception->getMessage());
        }
    }

    private function getAttributeValues()
    {
        return (new AttributeValueRepository)->get(
            $this->getRequest($this->getAttributes()),
            10,
            $this->sortOrder,
            $this->orderBy
        );
    }

    private function getAttributes(): array
    {
        return [
            'search' => $this->search,
            'attribute_id' => $this->attribute->id
        ];
    }
}
