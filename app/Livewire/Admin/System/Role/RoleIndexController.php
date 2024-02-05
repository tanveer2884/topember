<?php

namespace App\Livewire\Admin\System\Role;

use App\Livewire\Admin\System\SystemAbstract;
use App\Livewire\Traits\ResetsPagination;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleIndexController extends SystemAbstract
{
    use WithPagination;
    use ResetsPagination;

    public string $search = '';

    public string $showTrashed = '';

    public function render(): View
    {
        return $this->view('livewire.admin.system.role.role-index-controller', function (View $view) {
            $view->with('roles', $this->getRoles());
        });
    }

    public function getRoles(): Paginator
    {
        $query = Role::query();

        if ($this->search) {
            $query->search($this->search);
        }

        return $query->paginate(10);
    }
}
