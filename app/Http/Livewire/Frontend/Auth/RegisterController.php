<?php

namespace App\Http\Livewire\Frontend\Auth;

use App\Models\User;
use Livewire\Component;
use App\Mail\NewAccountRegistered;
use App\Rules\PasswordValidator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Component
{
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $confirmPassword;
    
    public function mount()
    {
        $this->initializeFields();
    }

    public function render()
    {
        return view('livewire.frontend.auth.register-controller');
    }

    public function register()
    {

        $data = $this->validate([
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                new PasswordValidator()
            ],
            'confirmPassword' => 'required|same:password',
        ]);


        $data['name'] = $data['first_name'];
        $data['password'] = bcrypt($data['password']);
        
        $user = User::create($data);

        Mail::send(new NewAccountRegistered($user));
        session()->flash('alert-success','Account Created Successfully. Login now');
        $this->emit('alert-success','Account Created Successfully');

        $this->initializeFields();
        return redirect()->route('user.login');
    }

    public function initializeFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
        $this->confirmPassword = '';
    }
}
