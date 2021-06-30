<?php

namespace Topdot\Product\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Topdot\Core\Traits\HasSorting;
use Topdot\Core\Traits\WithUniqueId;
use Topdot\Product\Contracts\Product;
use Topdot\Core\Traits\ResetsPagination;
use Topdot\Core\Traits\InteractsWithRequests;
use Topdot\Product\Contracts\ProductRepository;

class TableComponent extends Component
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
        return view('product::livewire.table-component',[
            'products' => $this->getProducts()
        ]);
    }

    public function delete($product, ProductRepository $productRepository)
    {
        try {
            $productRepository->delete( app(Product::class)->find($product) );
            $this->emit('alert-success','Product Deleted Successfully');
        }catch (\Exception $exception){
            $this->emit('alert-danger',$exception->getMessage());
        }
    }

    private function getProducts()
    {
        return app()->make(ProductRepository::class)->get(
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
