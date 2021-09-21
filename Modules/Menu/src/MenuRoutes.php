<?php

namespace Topdot\Menu;

class MenuRoutes
{
    public $routeFilePath = '/routes/menu.php';
    
    public function menuRoutes()
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