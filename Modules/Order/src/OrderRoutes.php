<?php

namespace Topdot\Order;

class OrderRoutes
{
    public $routeFilePath = '/routes/orders.php';
    
    public function orderRoutes()
    {
        $filePath = $this->routeFilePath;

        return function ($options = []) use($filePath){
            $routeFilePathInUse = __DIR__ . $filePath;

            if (file_exists(base_path() . $filePath)) {
                $routeFilePathInUse = base_path() . $filePath;
            }

            $this->group([],function() use($routeFilePathInUse){
                require $routeFilePathInUse;
            });
        };
    }
}
