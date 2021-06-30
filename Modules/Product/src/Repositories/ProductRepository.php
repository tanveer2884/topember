<?php


namespace Topdot\Product\Repositories;

use Illuminate\Http\Request;
use Topdot\Core\Models\TempMedia;
use Illuminate\Support\Facades\DB;
use Topdot\Product\Contracts\Product;
use Topdot\Core\Contracts\Repositories\CanFilterRecords;
use Topdot\Product\Contracts\ProductRepository as ContractsProductRepository;

class ProductRepository implements CanFilterRecords, ContractsProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;    
    }

    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        $query = $this->product->query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%{$request->search}%")
                ->orWhere('sku', 'LIKE', "%{$request->search}%")
                ->orWhere('price', 'LIKE', "%{$request->search}%");
        }

        if ($request->active) {
            $query->active();
        }

        $query->orderBy($orderBy, $sortOrder);

        return false !== $paginate ? $query->paginate($paginate) : $query->get();
    }

    public function store(Request $request)
    {
        $product = $this->product->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'model_number' => $request->model_number,
            'qty' => $request->qty,
            'weight' => $request->weight,
            'is_active' => $request->is_active ? true : false,
            'is_inStock' => $request->is_inStock ? true : false,
            'is_featured' => $request->is_featured ? true : false,
            'is_recommended' => $request->is_recommended ? true : false,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'special_price' => $request->special_price ?? 0,
            'special_start_at' => $request->special_start_at,
            'special_end_at' => $request->special_end_at,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description
        ]);

        $product->categories()->sync($request->get('categories', []));

        foreach (TempMedia::find($request->get('feature', [])) as $tempThumbnail) {
            $tempThumbnail->getFirstMedia('default')->move($product, 'feature');
        }

        foreach (TempMedia::find($request->get('additional_images', [])) as $tempImage) {
            $tempImage->getFirstMedia('default')->move($product, 'additional_images');
        }

        return $product;
    }

    public function update(Product $product, Request $request)
    {
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'model_number' => $request->model_number,
            'qty' => $request->qty,
            'weight' => $request->weight,
            'is_active' => $request->is_active ? true : false,
            'is_inStock' => $request->is_inStock ? true : false,
            'is_featured' => $request->is_featured ? true : false,
            'is_recommended' => $request->is_recommended ? true : false,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'special_price' => $request->special_price ?? 0,
            'special_start_at' => $request->special_start_at,
            'special_end_at' => $request->special_end_at,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description
        ]);

        $product->categories()->sync($request->get('categories', []));

        foreach (TempMedia::find($request->get('feature', [])) as $tempThumbnail) {
            $tempThumbnail->getImage()->move($product, 'feature');
        }

        foreach (TempMedia::find($request->get('additional_images', [])) as $tempImage) {
            $tempImage->getImage()->move($product, 'additional_images');
        }

        return $product;
    }

    public function delete(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->categories()->sync([]);
            $product->delete();
        });
    }
}
