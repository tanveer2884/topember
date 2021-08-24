<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Topdot\Core\Traits\HasSorting;
use Topdot\Product\Models\Product;
use Topdot\Category\Models\Category;
use Topdot\Core\Traits\WithUniqueId;
use Illuminate\Support\Facades\Cookie;
use Topdot\Core\Traits\ResetsPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductListing extends Component
{
    use WithPagination,
        WithUniqueId,
        HasSorting,
        ResetsPagination;

    const ViewTypeGrid = 'grid';
    const ViewTypeLIST = 'list';

    protected $listeners = [
        'filters-updated' => 'setFilters',
        'price-updated' => 'setPriceFilter',
        'updated-sortby' => 'setProductsSortBy'
    ];

    public $viewType;
    public $categories;
    public $category;
    public $baseUrl;
    public $pageSize;
    public $filters;
    public $priceMin;
    public $priceMax;
    public $productsSortBy;

    public function mount($categories = [], $category = null, $baseUrl = null)
    {
        $this->categories = $categories;
        $this->category = $category;
        $this->baseUrl = $baseUrl;
        $this->pageSize = 10;
        $this->filters =[];
        $this->priceMin = 0;
        $this->priceMax = 0;
        $this->productsSortBy = 'newest';
        $this->viewType = Cookie::get('product-list-style', self::ViewTypeGrid);
    }

    
    public function render()
    {
        $this->emit('products-loaded');
        return view('livewire.frontend.product.product-listing',[
            'products' => $this->getProducts()
        ]);
    }
    
    public function loadMore()
    {
        $this->pageSize +=10;
    }

    public function setFilters($filters)
    {
        $this->filters = $filters;
    }
    
    public function setPriceFilter($price)
    {
        list($this->priceMin,$this->priceMax) = $price;
    }

    public function setProductsSortBy($productsSortBy)
    {
        $this->productsSortBy = $productsSortBy;

        switch( $productsSortBy ){
            case 'az':
                $this->orderBy = 'name';
                $this->sortOrder = 'ASC';
                break;
            case 'za':
                $this->orderBy = 'name';
                $this->sortOrder = 'DESC';
                break;
            case 'newest':
                $this->orderBy = 'created_at';
                $this->sortOrder = 'DESC';
                break;
            case 'oldest':
                $this->orderBy = 'created_at';
                $this->sortOrder = 'ASC';
                break;
            case 'is_featured':
                $this->orderBy = 'is_featured';
                $this->sortOrder = 'DESC';
                break;
        }

    }

    public function getProducts()
    {
        $query = Product::query()
            ->select('products.*')
            ->active()
            ->inStock()
            ->isAvailable()
            ->whereHas('categories', function ($query) {
                return $query->where('id', $this->category->id);
            });
        
            // dd($this->filters);
        if ( count($this->filters) >0 ){
            foreach ($this->filters as $filter => $values) {
                $query->whereHas('attributeValues',function($query) use($values){
                    return $query->whereIn('id',$values);
                });
            }
        }

        if ( $this->priceMin > 0 ){
            $query->where('price','>=',$this->priceMin);
        }

        if ( $this->priceMax > 0 ){
            $query->where('price','<=',$this->priceMax);
        }


        if ( $this->productsSortBy == 'best_selling' ){
            $query->addSelect(DB::raw('SUM(order_product.qty) as total_sales'))
            ->join('order_product', function ($query) {
                $query->on('order_product.product_id', 'products.id');
            })
            ->join('orders', function ($query) {
                $query->on('order_product.order_id', 'orders.id');
            })
            ->groupBy('products.id');

            $this->sortOrder = 'DESC';
            $this->orderBy = 'total_sales';
        }

        if ( $this->productsSortBy !== 'best_selling' && $this->orderBy == 'total_sales' ){
            $this->orderBy = 'id';
        }

        $query->orderBy($this->orderBy,$this->sortOrder);

        if ( $this->pageSize !==false ){
            $products = $query->paginate($this->pageSize);
        }

        if ( $this->productsSortBy == 'cheapest' ){
            $products = $this->customPaginate($products->sortBy(function($product){
                return $product->getPrice();
            }),$products);
        }

        if ( $this->productsSortBy == 'expensive' ){
            $products = $this->customPaginate($products->sortByDesc(function($product){
                return $product->getPrice();
            }), $products);
        }

      
        return $products;
    }

    private function customPaginate($results, $originalPaginator)
    {
        return (new LengthAwarePaginator($results, $originalPaginator->total(), $originalPaginator->perPage()));
    }
}
