<?php

namespace App\Livewire\Admin\Cms\Projects;

use App\Models\Project;
use Livewire\Component;
use App\Livewire\Admin\Cms\Projects\ProjectsAbstract;

class ProjectCreateController extends ProjectsAbstract
{
    public function mount(): void
    {
        $this->project = new Project();
    }
}
