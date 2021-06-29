<?php

namespace Topdot\Core\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Topdot\Core\Contracts\HasStatus;

class StatusToggleComponent extends Component
{
    public Model $model;

    public function mount($model)
    {
        $this->model = $model;
    }

    public function render()
    {
        if ( !$this->model instanceof  HasStatus){
            return '<div></div>';
        }

        return view('core::livewire.status-toggle-component');
    }

    public function markActive()
    {
        $this->model->markActive(true);
    }

    public function markDisable()
    {
        $this->model->markActive(false);
    }


}
