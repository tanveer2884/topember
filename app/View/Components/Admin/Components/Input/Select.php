<?php

namespace App\View\Components\Admin\Components\Input;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Whether or not the input has an error to show.
     */
    public bool $error = false;

    /**
     * Initialize the component.
     *
     * @param  bool  $error
     */
    public function __construct($error = false)
    {
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.input.select');
    }
}
