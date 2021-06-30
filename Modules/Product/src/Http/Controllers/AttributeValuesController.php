<?php

namespace Topdot\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Topdot\Product\Models\Attribute;

class AttributeValuesController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Attribute $attribute)
    {
        return view('product::attributes.values',compact('attribute'));
    }
}
