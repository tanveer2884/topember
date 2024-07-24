<?php

namespace App\Livewire\Admin\Cms\Members;

use Livewire\Component;
use App\Livewire\Traits\CanDeleteRecord;

class MemberShowController extends MemberAbstract
{
    use CanDeleteRecord;

    public function delete(): void
    {
        $this->member->delete();
        $this->notify('Member Deleted Successfully', 'admin.cms.members.index');
    }

    /**
     * return field to verify for delete
     */
    public function getCanDeleteConfirmationField(): string
    {
        return 'delete';
    }
}
