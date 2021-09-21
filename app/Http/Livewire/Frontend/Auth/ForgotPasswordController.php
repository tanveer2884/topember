<?php

namespace App\Http\Livewire\Frontend\Auth;

use Exception;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPasswordController extends Component
{
    public $email;

    public function mount()
    {
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.frontend.auth.forgot-password-controller');
    }

    public function sendPasswordResetLink()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email'
        ],[
            'email.exists' => 'No account found with this email'
        ]);

        try{

            $response = Password::broker()->sendResetLink([
                'email' => $this->email
            ]);

            $response == Password::RESET_LINK_SENT ?
                $this->emit('alert-success','Email sent successfully'):
                $this->emit('alert-danger',__($response));
            $this->email = '';

        }catch(Exception $ex){
            $this->emit('alert-danger',"Error while sending password reset link. please try again");
        }
    }
}
