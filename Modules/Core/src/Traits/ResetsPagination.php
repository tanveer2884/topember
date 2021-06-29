<?php


namespace Topdot\Core\Traits;


trait ResetsPagination
{
    public function updated()
    {
        $this->resetPage();
    }
}
