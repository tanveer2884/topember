<?php

namespace Topdot\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Topdot\Product\Models\Attribute;
use Topdot\Product\Repositories\AttributeRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AttributesController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('product::attributes.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param AttributeRepository $attributeRepository
     */
    public function store(Request $request, AttributeRepository $attributeRepository)
    {
        try {
            $product = $attributeRepository->store($request);
            session()->flash('alert-success', 'Attribute Created Successfully');
            return redirect()->route(config('product.routeNamePrefix').'attributes.index');
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
        return view('product::attributes.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function edit(Attribute $attribute)
    {
        return view('product::attributes.edit',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Product $product
     * @param ProductRepository $attributeRepository
     * @return Renderable
     */
    public function update(Request $request,Attribute $attribute, AttributeRepository $attributeRepository)
    {
        try {
            $attributeRepository->update($attribute, $request);
            session()->flash('alert-success', 'Product Updated Successfully');
            return redirect()->route( config('product.routeNamePrefix').'attributes.index');
        }catch (\Exception $exception){
            session()->flash('alert-danger','Error: '.$exception->getMessage());
            return back()->withInput();
        }
    }
}
