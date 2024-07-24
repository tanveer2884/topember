<?php

namespace App\Livewire\Admin\Cms\Projects;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Livewire\Traits\Notifies;
use App\Livewire\Admin\Cms\CmsAbstract;
use App\Livewire\Traits\ResetsPagination;
use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectIndexController extends CmsAbstract
{
    use WithPagination;
    use ResetsPagination;
    use Notifies;

    public string $search = '';

    public bool $showTrashed = false;

    public function getProjectsProperty(): LengthAwarePaginator
    {
        return Project::query()
            ->with('thumbnail')
            ->when($this->search, fn ($q) => $q->search($this->search))
            ->when($this->showTrashed, fn ($q) => $q->withTrashed())
            ->paginate(10);
    }
    
    public function render(): View
    {
        return $this->view('livewire.admin.cms.projects.project-index-controller');
    }

    /**
     * Force delete our project
     *
     * @param  int|null  $id
     */
    public function forceDelete($id): void
    {
        try {
            Project::onlyTrashed()->find($id)->forceDelete();

            $this->notify(__('member.form.member.deleted_permanently'), 'admin.cms.members.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }

    /**
     * Restore our Project
     *
     * @param  int|null  $id
     */
    public function restore($id): void
    {
        try {
            Project::withTrashed()->find($id)->restore();

            $this->notify(__('member.form.member.restore'), 'admin.cms.members.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }
}
