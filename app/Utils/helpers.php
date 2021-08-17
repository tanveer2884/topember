<?php

use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\User;
use Topdot\Product\Models\Product;
use Topdot\Category\Models\Category;
use Darryldecode\Cart\Facades\CartFacade;

function cleanString($string)
{
    $res = preg_replace("/[^a-zA-Z0-9]/", "", $string);
    return $res;
}

// function states($columns = ['id','code'])
// {
//     return State::select($columns)->get();
// }

function isCategory($slug)
{
    return Category::where('slug',$slug)->first();
}

function isProduct($slug,$secondLastSlug = null)
{
    $query = app(Product::class)->query()->where('slug',$slug);
    if ( $secondLastSlug ){
        $query->whereHas('categories',function($query) use($secondLastSlug){
            return $query->where('slug',$secondLastSlug);
        });
    }
    return $query->first();
}

function verifyUriPathAgainstCategories(array $categories)
{
    $reverseCategories = array_reverse($categories);
    $total = count($reverseCategories);
    $query = Category::query()->from((new Category())->getTable().' as s1')->select('s1.*');

    for($i=1; $i<$total; $i++){
        $query->join((new Category())->getTable().' as s'.($i+1),function($join) use($i){
            $join->on("s".($i+1).".id","s".$i.".parent_category_id");
        })
        ->where("s{$i}.slug",$reverseCategories[$i-1]);
    }

    if ( $query->count() > 0 ){
        return Category::whereSlug( optional($reverseCategories)[0] )->first();
    };

    return false;
}


function productsMenu()
{
    return Category::doesntHave('parentCategory')->with('subCategories')->oldest('name')->get();
}


function categoriesBySlugs($slugs = [],$columns=['id','name','slug'])
{
    return Category::whereIn('slug',$slugs)->get($columns);
}

// function getRecentlyViewedProducts()
// {
//     return \RecentlyViewed\Facades\RecentlyViewed::get(Product::class)->slice(1);
// }

function products(array $except = [],array $columns = ['id','name'])
{
    return Product::whereNotIn('id',$except)->get($columns);
}

// function brands(array $except = [],array $columns = ['id','name'])
// {
//     return Brand::whereNotIn('id',$except)->get($columns);
// }

// function tagsSimple(array $except = [],array $columns = ['id','name'])
// {
//     return Tag::whereNotIn('id',$except)->usedIn(false)->get($columns);
// }

// function tagsUsedIn(array $except = [],array $columns = ['id','name'])
// {
//     return Tag::whereNotIn('id',$except)->usedIn(true)->get($columns);
// }


function array_filter_recursive( array $array, callable $callback = null ) {
    $array = is_callable( $callback ) ? array_filter( $array, $callback ) : array_filter( $array );
    foreach ( $array as &$value ) {
        if ( is_array( $value ) ) {
            $value = call_user_func( __FUNCTION__, $value, $callback );
        }
    }

    return $array;
}

function cartHas($key)
{
    return optional(CartFacade::getExtraData())[$key];
}

function getFeaturedCategories(){
    return \Topdot\Category\Models\Category::whereIsFeatured(1)->whereIsActive(1)->get();
}


function getFeaturedProducts(){
    return Product::whereIsFeatured(1)->whereIsActive(1)->get();
}

// function getFeaturedBlogs(){
//     return \Topdot\Blog\Models\Blog::featured()->whereIsActive(1)->get();
// }

// function get_addresses($columns=['id','nickname'])
// {
//     return Address::select($columns)->where('user_id',Auth::id())->get();
// }

function users($columns = ['id','name','last_name'], $except=[1])
{
    return User::query()->select($columns)->whereNotIn('id',$except)->get();
}

function isActiveUrl($url,$activeClass ='active' )
{
    if ( request()->path() == $url ){
        return 'active';
    }

    return null;
}

function getHomepageProducts()
{
    return Product::query()->active()->homepage()->get();
}

function getHomepageFaqs()
{
    return Faq::query(Faq::TYPE_HOMEPAGE)->get();
}

function getHomepageTestimonials()
{
    return Testimonial::query()->limit(12)->get();
}