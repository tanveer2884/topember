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
        $address->delete();
        $this->emit('alert-success','Address Deleted Successfully.');
    }

    public function getAddresses()
    {
        $query = Address::query();

        $query->where('user_id',Auth::id());

        return $query->latest()->paginate(10);

    }
}
