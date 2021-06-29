<?php

namespace Topdot\Core\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImagePreviewComponent extends Component
{
    public Model $model;
    public string $collection;

    public function mount($model, $collection)
    {
        $this->model = $model;
        $this->collection = $collection;
    }

    public function render()
    {
        return view('core::livewire.image-preview-component');
    }

    public function remove(Media $media)
    {
        $media->delete();
        $this->model->refresh();
    }
}
