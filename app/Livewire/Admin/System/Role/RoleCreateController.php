<?php

namespace App\Livewire\Admin\System\Role;

use App\Livewire\Traits\Notifies;
use App\Services\Admin\PermissionProviderService;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class RoleCreateController extends RoleAbstract
{
    use Notifies;

    /**
     * Called when the component has been mounted.
     *
     * @return void
     */
    public function mount()
    {
        $this->role = new Role();

        $this->rolePermissions = $this->role->permissions->pluck('name');
    }

    public function render(PermissionProviderService $permissionService): View
    {
        return $this->view('livewire.admin.system.role.role-create-controller', function (View $view) use ($permissionService) {
            $view->with('permissions', $permissionService->getGroupedPermissions());
        });
    }

    public function create(): void
    {
        $this->validate();

        $this->role->save();

        $this->syncPermissions();

        $this->notify(trans('notifications.role.created'), 'admin.system.role.index');
    }
}
