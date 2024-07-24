<?php

namespace App\Livewire\Admin\Cms\Members;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Traits\Notifies;
use App\Livewire\Admin\Cms\CmsAbstract;
use App\Livewire\Traits\ResetsPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;


class MemberIndexController extends CmsAbstract
{
    use WithPagination;
    use ResetsPagination;
    use Notifies;

    public string $search = '';

    public bool $showTrashed = false;

    public function getMembersProperty(): LengthAwarePaginator
    {
        return Member::query()
            ->with('thumbnail')
            ->when($this->search, fn ($q) => $q->search($this->search))
            ->when($this->showTrashed, fn ($q) => $q->withTrashed())
            ->paginate(10);
    }

    public function render(): View
    {
        return $this->view('livewire.admin.cms.members.member-index-controller');
    }

    /**
     * Force delete our member
     *
     * @param  int|null  $id
     */
    public function forceDelete($id): void
    {
        try {
            Member::onlyTrashed()->find($id)->forceDelete();

            $this->notify(__('member.form.member.deleted_permanently'), 'admin.cms.members.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }

    /**
     * Restore our member
     *
     * @param  int|null  $id
     */
    public function restore($id): void
    {
        try {
            Member::withTrashed()->find($id)->restore();

            $this->notify(__('member.form.member.restore'), 'admin.cms.members.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }
}
