<?php

namespace App\Http\Livewire\Frontend\Account\Address;

use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateEditAddress extends Component
{
    public $nickname;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $address2;
    public $city;
    public $zipCode;
    public $state;
    public $country;

    public $defaultBilling;
    public $defaultShipping;

    public ?Address $_address;

    public function mount(Address $address = null)
    {
        $this->_address = $address;
        $this->initializeFields();
    }

    public function render()
    {
        return view('livewire.frontend.account.address.create-edit-address');
    }

    public function submit()
    {
        $data = $this->validate([
            'nickname' => 'required|max:191|unique:addresses,nickname'.($this->_address ? ','.$this->_address->id : ''),
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'required|email',
            'phone' => 'required|max:20',
            'address' => 'required|max:191',
            'address2' => 'nullable|max:191',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zipCode' => 'required|max:20',
        ]);

        $data['full_name'] = $data['first_name'] . " " . $data['last_name'];

        if ( $this->_address->id ){
            $this->_address->update($data);

            session()->flash('alert-success','Address Updated Successfully.');
            return redirect()->route('user.addresses.index');
        }

        $data['user_id'] = Auth::id();
        Address::create($data);

        session()->flash('alert-success','Address Created Successfully.');
        $this->initializeFields();
        return redirect()->route('user.addresses.index');

    }

    public function initializeFields()
    {
        $this->nickname = optional($this->_address)->nickname;
        $this->first_name = optional($this->_address)->first_name;
        $this->last_name = optional($this->_address)->last_name;
        $this->email = optional($this->_address)->email;
        $this->phone = optional($this->_address)->phone;
        $this->address = optional($this->_address)->address;
        $this->address2 = optional($this->_address)->address2;
        $this->city = optional($this->_address)->city;
        $this->state = optional($this->_address)->state;
        $this->zipCode = optional($this->_address)->zipCode;
        $this->country = optional($this->_address)->country;
    }
}
