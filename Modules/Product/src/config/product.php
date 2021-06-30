<?php 

return [
    'routeNamePrefix' => config('app.adminRouteNamePrefix','admin.'),
    'factoryClass' => null,
    'classes' => [
        'product' => \Topdot\Product\Models\Product::class,
        'prodctRepository' => \Topdot\Product\Repositories\ProductRepository::class,
        'createRequest' => \Topdot\Product\Http\Requests\CreateProductRequest::class,
        'updateRequest' => \Topdot\Product\Http\Requests\UpdateProductRequest::class
    ]
];