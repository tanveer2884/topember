<?php

namespace Topdot\Product\Http\Controllers;

use Illuminate\Routing\Controller;

use Topdot\Product\Contracts\Product;
use Illuminate\Contracts\Support\Renderable;
use Topdot\Product\Contracts\ProductRepository;
use Topdot\Product\Contracts\CreateProductRequest;
use Topdot\Product\Contracts\UpdateProductRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('product::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateProductRequest $request
     * @param ProductRepository $productRepository
     */
    public function store(CreateProductRequest $request, ProductRepository $productRepository)
    {
        try {
            $product = $productRepository->store($request);
            session()->flash('alert-success', 'Product Created Successfully');
            return redirect()->route(config('product.routeNamePrefix').'products.index');
        }catch (\Exception $exception){
            session()->flash('alert-danger','Error: '.$exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function edit($product)
    {
        $product = app(Product::class)->resolveRouteBinding($product);
        return view('product::edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateProductRequest $request
     * @param Product $product
     * @param ProductRepository $productRepository
     * @return Renderable
     */
    public function update(UpdateProductRequest $request,$product, ProductRepository $productRepository)
    {
        try {
            
            $product = app(Product::class)->resolveRouteBinding($product);
            $productRepository->update($product, $request);
            session()->flash('alert-success', 'Product Updated Successfully');
            return redirect()->route( config('product.routeNamePrefix').'products.index');
        }catch (\Exception $exception){
            session()->flash('alert-danger','Error: '.$exception->getMessage());
            return back()->withInput();
        }
    }
}
