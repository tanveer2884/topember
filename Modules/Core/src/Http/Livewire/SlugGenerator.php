<?php

namespace Topdot\Core\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class SlugGenerator extends Component
{
    public ?Model $model;
    public $title;
    public $slug;
    public $required;

    public function mount($model=null, $required=false)
    {
        $this->model = $model;
        $this->required = $required;
        if ($this->model) {
            $this->title = old('title',$this->model->title??'');
            $this->slug = old('slug',$this->model->slug??'');
            return;
        }

        $this->title = old('title','');
        $this->slug = old('slug','');

    }

    public function render()
    {
        return view('core::livewire.slug-generator');
    }

    public function updatedTitle()
    {
        $this->slug = \Str::slug($this->title??'');
    }
}
