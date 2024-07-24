<?php

namespace App\Livewire\Admin\Cms\Projects;

use App\Models\Project;
use Livewire\WithFileUploads;
use App\Livewire\Traits\Notifies;
use App\Livewire\Traits\HasImages;
use Illuminate\Contracts\View\View;
use App\Livewire\Admin\Cms\CmsAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Livewire\Traits\RegistersDynamicListeners;

class ProjectsAbstract extends CmsAbstract
{
    use Notifies;
    use WithFileUploads;
    use HasImages;
    use RegistersDynamicListeners;

    public int $maxFileSize = 15; //file size in MBs

    public int $maxFiles = 1; //number of images allowed

    /** @var string[] */
    public array $filetypes = ['image/jpg', 'image/jpeg', 'image/png'];

    public Project $project;
    
    /**
     * @return array<string,string>
     */
    protected function getListeners(): array
    {
        return array_merge(
            $this->getDynamicListeners(),
            $this->getHasImagesListeners()
        );
    }

    public function getMediaModel(): Model
    {
        return $this->project;
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'project.title' => 'bail|required',
            'project.slug' => 'bail|nullable|unique:projects,slug,' . $this->project->id,
            'project.description' => 'bail|required',
            'project.link' => 'bail|nullable',
            'images' => 'required',
        ];
    }


    /**
     * Save the blog in database
     */
    public function save(): void
    {
        $this->validate();

        try {

            $this->project->save();
            $this->updateImages();

            $type = $this->project->wasRecentlyCreated ? 'created' : 'updated';

            $this->notify("Project {$type} successfully.", 'admin.cms.projects.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }

    public function render(): View
    {
        $title = $this->project->id ? 'edit' : 'create';

        return $this->view('livewire.admin.cms.projects.project-form')
        ->with('projectTitle', "project.{$title}.title");
    }
}