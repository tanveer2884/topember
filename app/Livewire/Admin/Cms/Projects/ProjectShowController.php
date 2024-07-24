<?php

namespace App\Livewire\Admin\Cms\Projects;

use Livewire\Component;
use App\Livewire\Traits\CanDeleteRecord;

class ProjectShowController extends ProjectsAbstract
{
    use CanDeleteRecord;

    public function delete(): void
    {
        $this->project->delete();
        $this->notify('Project Deleted Successfully', 'admin.cms.projects.index');
    }

    /**
     * return field to verify for delete
     */
    public function getCanDeleteConfirmationField(): string
    {
        return 'delete';
    }
}
