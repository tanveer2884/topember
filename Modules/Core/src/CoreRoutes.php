<?php

namespace Topdot\Core;

class CoreRoutes
{
    public $routeFilePath = '/routes/core.php';
    public $routeFilePathPublic = '/routes/public.php';
    
    public function registerRoutes()
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

    public function registerPublicRoutes()
    {
        $filePath = $this->routeFilePathPublic;

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
