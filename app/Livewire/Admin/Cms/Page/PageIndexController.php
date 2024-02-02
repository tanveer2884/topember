<?php

namespace App\Livewire\Admin\Cms\Page;

use App\Livewire\Admin\Cms\CmsAbstract;
use App\Livewire\Traits\Notifies;
use App\Livewire\Traits\ResetsPagination;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class PageIndexController extends CmsAbstract
{
    use Notifies;
    use WithPagination;
    use ResetsPagination;

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
}
