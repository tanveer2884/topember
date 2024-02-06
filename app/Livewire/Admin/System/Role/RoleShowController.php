<?php

namespace App\Livewire\Admin\System\Role;

use App\Livewire\Traits\CanDeleteRecord;
use App\Livewire\Traits\Notifies;
use App\Services\Admin\PermissionProviderService;
use Illuminate\Contracts\View\View;

class RoleShowController extends RoleAbstract
{
    use CanDeleteRecord;
    use Notifies;

    public function mount()
    {
        $this->rolePermissions = $this->role->permissions->pluck('name');
    }

    public function render(PermissionProviderService $permissionService): View
    {
        return $this->view('livewire.admin.system.role.role-show-controller', function (View $view) use ($permissionService) {
            $view->with('permissions', $permissionService->getGroupedPermissions());
        });
    }

    public function update(): void
    {
        $this->validate();

        $this->role->save();

        $this->syncPermissions();

        $this->notify(trans('notifications.role.updated'));
    }

    public function delete(): void
    {
        $this->role->delete();

        $this->notify(trans('notifications.role.deleted'), 'admin.system.role.index');
    }

    /**
     * return field to verify for delete
     */
    public function getCanDeleteConfirmationField(): string
    {
        return $this->role->name;
    }
}
