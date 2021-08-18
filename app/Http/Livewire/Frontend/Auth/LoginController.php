<?php

namespace App\Http\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginController extends Component
{
    public $username;
    public $password;
    public $redirect;

    public function mount($redirect = null)
    {
        $this->resetFields();
        $this->redirect = $redirect;
    }

    public function render()
    {
        return view('livewire.frontend.auth.login-controller');
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ],[
            'username.required' => 'The email field is required'
        ]);

        if ( Auth::attempt([
            'email' => $this->username,
            'password' => $this->password
        ]) ){
            return redirect()->intended($this->redirect ?? route('user.my-account'));
        }

        // if ( Auth::attempt([
        //     'username' => $this->username,
        //     'password' => $this->password
        // ]) ){
        //     return redirect()->intended($this->redirect ?? route('user.my-account'));
        // }

        $this->addError('username','Invalid Credentials');
        $this->emit('alert-danger','Invalid Credentials');
    }

    public function resetFields()
    {
        $this->username = '';
        $this->password = '';
    }
}
