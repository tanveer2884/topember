<?php

namespace Topdot\Product\Http\Controllers;

use Illuminate\Routing\Controller;

use Topdot\Product\Contracts\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductAttributesController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function index($product)
    {
        $product = app(Product::class)->resolveRouteBinding($product);
        return view('product::attributes',compact('product'));
    }
}
