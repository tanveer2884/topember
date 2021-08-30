<?php

namespace App\Http\Livewire\Frontend\Account;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyAccountForm extends Component
{
    public $tax_id;
    public $name;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $address2;
    public $city;
    public $country;
    public $state;
    public $zipCode;

    public function mount()
    {
        $this->initializeFields();
    }

    public function render()
    {
        return view('livewire.frontend.account.my-account-form');
    }

    public function register()
    {
        $data = $this->validate([
            //'tax_id' => 'nullable|max:191',
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            /*'email' => 'required|email|unique:users,email,'.Auth::id(),
            'phone' => 'required|max:20',
            'address' => 'required|max:191',
            'address2' => 'nullable|max:191',
            'city' => 'required|max:191',
            'country' => 'required|max:191',
            'state' => 'required|exists:states,code',
            'zipCode' => 'required'*/
        ]);

        $data['name'] = $data['first_name'] ." ".$data['last_name'];

        Auth::user()->update($data);

        $this->emit('alert-success','Profile Updated Successfully.');

        $this->initializeFields();
    }

    public function initializeFields()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        /*$this->phone = $user->phone;
        $this->address = $user->address;
        $this->address2 = $user->address2;
        $this->city = $user->city;
        $this->state = $user->state;
        $this->zipCode = $user->zipCode;
        $this->tax_id = $user->tax_id;
        $this->country = $user->country;*/
    }
}
