<?php

namespace App\Http\Livewire\Frontend\Header;

use Livewire\Component;
use Topdot\Product\Models\Product;

class SearchBar extends Component
{
    public $search;

    public function render()
    {
        return view('livewire.frontend.header.search-bar',[
            'products' => $this->getProducts(),
            'isSearched' => $this->isSearched()
        ]);
    }

    public function getProducts()
    {
        if ( strlen(trim($this->search)) <=1 ){
            return collect();
        }

        $query = Product::query();

        $query->where('name','LIKE',"%{$this->search}%")
            ->orWhere('sku','LIKE',"%{$this->search}%")
            ->orWhere('model_number','LIKE',"%{$this->search}%")
            ->orWhere('short_description','LIKE',"%{$this->search}%")
            ->orWhere('description','LIKE',"%{$this->search}%");

        return $query->active()->get();
    }

    public function isSearched()
    {
        return strlen(trim($this->search)) > 0;
    }
}
