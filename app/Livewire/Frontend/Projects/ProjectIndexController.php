<?php

namespace App\Livewire\Frontend\Projects;

use App\Models\Project;
use Livewire\Component;

class ProjectIndexController extends Component
{
    public function render()
    {
        $projects = Project::latest()->get();

        return view('livewire.frontend.projects.project-index-controller', compact('projects'));
    }
}
