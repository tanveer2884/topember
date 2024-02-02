<?php

namespace App\Livewire\Admin\Cms\Page;

use App\Models\Page;

class PageCreateController extends PageAbstract
{
    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->page = new Page(['is_published' => true]);
    }
}
