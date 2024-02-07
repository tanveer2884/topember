<?php

namespace App\Livewire\Admin\Cms\Page;

use App\Livewire\Admin\Cms\CmsAbstract;
use App\Livewire\Traits\Notifies;
use App\Livewire\Traits\ResetsPagination;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use Throwable;

class PageIndexController extends CmsAbstract
{
    use Notifies;
    use ResetsPagination;
    use WithPagination;

    public string $search = '';

    public bool $showTrashed = false;

    public function getPagesProperty(): LengthAwarePaginator
    {
        return Page::query()
            ->when($this->search, fn ($q) => $q->search($this->search))
            ->when($this->showTrashed, fn ($q) => $q->onlyTrashed())
            ->paginate(10);
    }

    public function render(): View
    {
        return $this->view('livewire.admin.cms.page.page-index-controller');
    }

    /**
     * Force delete page
     *
     * @param  int|null  $id
     */
    public function forceDelete($id): void
    {
        try {
            Page::onlyTrashed()->find($id)->forceDelete();

            $this->notify(__('pages.form.page.deleted_permanently'), 'admin.cms.pages.index');
        } catch (Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }

    /**
     * Restore page member
     *
     * @param  int|null  $id
     */
    public function restore($id): void
    {
        try {
            Page::withTrashed()->find($id)->restore();

            $this->notify(__('pages.form.page.restore'), 'admin.cms.pages.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }
}
