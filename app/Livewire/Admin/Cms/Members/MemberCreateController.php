<?php

namespace App\Livewire\Admin\Cms\Members;

use App\Models\Member;
use App\Livewire\Admin\Cms\Members\MemberAbstract;


class MemberCreateController extends MemberAbstract
{
    public function mount(): void
    {
        $this->member = new Member();
    }
}
