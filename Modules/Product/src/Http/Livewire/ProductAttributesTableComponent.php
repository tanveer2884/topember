<?php

namespace Topdot\Product\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Core\Traits\HasSorting;
use Topdot\Product\Models\Product;
use Topdot\Core\Traits\WithUniqueId;
use Topdot\Product\Models\Attribute;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Traits\InteractsWithRequests;

class ProductAttributesTableComponent extends Component
{
    protected string $paginationTheme = 'bootstrap';

    use HasSorting,
        WithUniqueId,
        WithPagination,
        InteractsWithRequests,
        ResetsPagination;

    protected $listeners = [
        'attributes-updated' => 'render'
    ];
    
    public Product $product;
    public string $search = '';

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('product::livewire.product-attributes-table-component',[
            'attributes' => $this->_getAttributes()
        ]);
    }

    public function delete(Attribute $attribute)
    {
        try {
            
            $this->product->attributes()->detach($attribute->id);
            $this->product->attributeValues()->detach( $this->product->attributeValueIds($attribute->id) );

            $this->emit('alert-success','Attribute Removed Successfully');
        }catch (\Exception $exception){
            $this->emit('alert-danger',$exception->getMessage());
        }
    }

    private function _getAttributes()
    {
        $this->product->refresh();
        return $this->product->attributes;
    }

    private function getAttributes(): array
    {
        return [
            'search' => $this->search
        ];
    }
}
