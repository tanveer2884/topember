<?php

namespace App\Http\Livewire\Frontend\Account;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public $old_password;
    public $new_password;
    public $confirm_password;

    public function mount()
    {
        $this->initializefields();
    }

    public function render()
    {
        return view('livewire.frontend.account.update-password-form');
    }

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
        ]);

        if ( !Hash::check($this->old_password,Auth::user()->password) ){
            $this->addError('old_password','Given Password is invalid.');
            return;
        }

        Auth::user()->update([
            'password' => bcrypt($this->new_password)
        ]);

        $this->emit('alert-success','Password Updated successfully.');
        $this->initializefields();
    }


    public function initializefields()
    {
        $this->old_password = '';
        $this->new_password = '';
        $this->confirm_password = '';
    }
}
