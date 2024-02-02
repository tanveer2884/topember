<?php

namespace App\Livewire\Traits;

trait CanDeleteRecord
{
    /**
     * Defines the confirmation text when deleting a model.
     *
     * @var string|null
     */
    public $deleteConfirm = null;

    public function getCanDeleteProperty(): bool
    {
        return $this->deleteConfirm == $this->getCanDeleteConfirmationField();
    }

    abstract public function getCanDeleteConfirmationField();

    abstract protected function delete();
}
