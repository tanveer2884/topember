<?php

namespace App\Http\Livewire\Frontend\Account\Address;

use App\Models\Address;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListAddress extends Component
{
    use WithPagination;

    protected $listeners = [
        'delete' => 'delete'
    ];

    public function render()
    {
        return view('livewire.frontend.account.address.list-address',[
            'addresses' => $this->getAddresses()
        ]);
    }

    public function delete(Address $address)
    {
        $address->unSetDefaultBilling()->unSetDefaultShipping();
        $address->delete();
        $this->emit('alert-success','Address Deleted Successfully');
    }

    public function getAddresses()
    {
        $query = Address::query();
        $defaultShippingAddress = Auth::user()->getDefaultShippingAddress();
        $defaultBillingAddress = Auth::user()->getDefaultBillingAddress();

        $query->where('user_id',Auth::id());

        if ( $defaultBillingAddress ){
            $query->where('id','<>',$defaultBillingAddress);
        }

        if ( $defaultShippingAddress ){
            $query->where('id','<>', $defaultShippingAddress);
        }

        return $query->latest()->paginate(10);

    }
}
