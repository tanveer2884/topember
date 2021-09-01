<?php

namespace App\Http\Livewire\Frontend\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginController extends Component
{
    public $username;
    public $password;
    public $redirect;
    public $checkout;

    public function mount($redirect = null,$checkout=false)
    {
        $this->resetFields();
        $this->redirect = $redirect;
        $this->checkout = $checkout;
    }

    public function render()
    {
        if ( $this->checkout ){
            return view('livewire.frontend.auth.login-controller-checkout');
        }

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
            'password' => $this->password,
            'is_active' => true
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
