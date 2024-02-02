<?php

namespace App\Providers;

use App\Services\Admin\PermissionProviderService;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $this->registerGates();
        
    }

    public function registerGates()
    {
        Gate::after(function ($user, $ability) {
            // Are we trying to authorize something within the hub?
            // $permission = PermissionProviderService::make()->getCachedPermissions()->first( fn ($permission) => $permission->name === $ability );
            // if ($permission) {
            //     return $user->is_admin || $user->authorize($ability);
            // }


            return $user->is_admin;

        });

    }

}
