<?php

namespace App\Http\Livewire\Frontend\Auth;

use App\Rules\PasswordValidator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Component
{
    public $token;
    public $email;
    public $password;
    public $confirm_password;

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request('email');
    }

    public function render()
    {
        return view('livewire.frontend.auth.reset-password-controller');
    }

    public function resetPassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'min:8',
                new PasswordValidator()
            ],
            'confirm_password' => 'required|same:password',
        ], [
            'email.exists' => 'No account found with given email'
        ]);

        $status = Password::reset([
                'email' => $this->email, 
                'password' => $this->password, 
                'password_confirmation' => $this->confirm_password,
                'token' => $this->token
            ],function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        if ( $status == Password::PASSWORD_RESET ){
            $this->emit('alert-success','Password Reset Successfully. Please Login');
            session()->flash('alert-success','Password Reset Successfully. Please Login');
            Auth::logout();
            $this->email = '';
            $this->password = '';
            $this->confirm_password = '';
            return redirect()->route('user.login');
        }
        
        $this->emit('alert-danger',__($status));
    }
}
