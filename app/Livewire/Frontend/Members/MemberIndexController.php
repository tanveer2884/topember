<?php

namespace App\Livewire\Frontend\Members;

use App\Models\Member;
use Livewire\Component;

class MemberIndexController extends Component
{
    public function render()
    {
        $members = Member::latest()->get();
        
        return view('livewire.frontend.members.member-index-controller', compact('members'));
    }
}
