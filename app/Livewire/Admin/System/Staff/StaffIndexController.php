<?php

namespace App\Livewire\Admin\System\Staff;

use App\Livewire\Admin\System\SystemAbstract;
use App\Livewire\Traits\Notifies;
use App\Models\Admin\Staff;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Throwable;

class StaffIndexController extends SystemAbstract
{
    use Notifies;
    use WithPagination;

    public string $search = '';

    public string $showTrashed = '';

    /**
     * render
     */
    public function render(): View
    {
        return $this->view('livewire.admin.system.staff.staff-index-controller', function (View $view) {
            $view->with('staff', $this->getStaff());
        });
    }

    public function getStaff(): Paginator
    {
        return Staff::query()
        ->when($this->search, fn ($q) => $q->search($this->search))
        ->when($this->showTrashed, fn ($q) => $q->onlyTrashed())
        ->paginate(10);
    }

    /**
     * Force delete staff
     *
     * @param  int|null  $id
     */
    public function forceDelete($id): void
    {
        try {
            Staff::onlyTrashed()->find($id)->forceDelete();

            $this->notify(__('staff.form.staff.deleted_permanently'), 'admin.system.staff.index');
        } catch (Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }

    /**
     * Restore staff member
     *
     * @param  int|null  $id
     */
    public function restore($id): void
    {
        try {
            Staff::withTrashed()->find($id)->restore();

            $this->notify(__('staff.form.staff.restore'), 'admin.system.staff.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }
}
