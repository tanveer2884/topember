<?php 
namespace Topdot\Product\Contracts;

use Illuminate\Http\Request;
use Topdot\Product\Contracts\Product;

interface ProductRepository
{
    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id');

    public function store(Request $request);

    public function update(Product $product, Request $request);

    public function delete(Product $product);
}