<?php

namespace App\Http\Controllers\Frontend;

use Topdot\Category\Models\Category;
use Topdot\Product\Models\Attribute;

class CategoryProductController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(array $categories = [], $product = null)
    {
        if (!$categories && !$product) {
            $categories = Category::query()->whereHas('products',function($query){
                $query->featured();
            })->get();

            return view('frontend.products.product-list',compact('categories'));
        }

        $category = verifyUriPathAgainstCategories($categories);

        if ((count($categories) <= 0 && !$product) && !$category) {
            abort(404);
        }

        $categories = categoriesBySlugs($categories);
        $baseUrl = $categories->pluck('slug')->join('/');

        if ($product) {
            // RecentlyViewed::add($product);
            // $product->addViewCount();
            return view('frontend.products.product-detail', compact('category', 'categories', 'baseUrl', 'product'));
        }

        // if ( $category && $category->subCategories()->exists() ) {

        //     $categoriesList = $category->subCategories;
        //     return view('frontend.products.categories',compact('category','categories','baseUrl','categoriesList'));
        // }

        $filters = $this->getProductFilters($category);
        $maxPrice = $category->products()->max('price');
        return view('frontend.products.index', compact('category','categories', 'maxPrice', 'filters', 'baseUrl'));
    }

    private function getProductFilters($category)
    {
        $query = Attribute::query();

        $query->whereHas('products',function($query) use($category){
            return $query->whereHas('categories',function($query) use($category){
                return $query->where('id',$category->id);
            });
        });

        $query->with(['values' => function($query){
            return $query->has('products');
        }]);

        $query->whereHas('values',function($query){
            return $query->has('products');
        });

        return $query->get();
    }
}
