<?php

namespace Topdot\Core\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Topdot\Core\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        foreach ($this->getPermissions() as $key => $path) {
            Permission::create([
                'slug' => $key,
                'group' => optional(explode('.', $key))[1],
                'description' => $path,
            ]);
        }

        foreach ($this->getOtherPermissions() as $key => $path) {
            Permission::create([
                'slug' => $key,
                'group' => $path,
                'description' => $path,
            ]);
        }

        $this->command->info('All Permissions seeded');
    }


    public function getOtherPermissions()
    {
        return config('core.other-permissions', []);
    }

    public function getPermissions()
    {
        return
            collect(Route::getRoutes()->getRoutesByName())->mapWithKeys(function ($route, $key) {
                return [$key => $route->uri];
            })
            ->reject(function ($route, $key) {
                return strpos($key, config('app.adminRouteNamePrefix')) === false;
            })->toArray();
    }
}
