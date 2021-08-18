<?php

namespace App\Http\Livewire\Frontend\Account\Payment;

use Livewire\Component;
use App\Models\PaymentProfile;

class PaymentBlock extends Component
{
    public $profile;

    public function mount(PaymentProfile $profile)
    {
        $this->profile = $profile;
    }

    public function render()
    {
        return view('livewire.frontend.account.payment.payment-block');
    }

    public function toggleDefault(PaymentProfile $paymentProfile)
    {
        if ( $paymentProfile->isDefault() ){
            $paymentProfile->unSetDefault();
            $this->emit('alert-success','Default payment profile removed.');
            return;
        }

        $paymentProfile->setDefault();
        $this->emit('alert-success','Payment Profile set as Default.');
        $this->emit('re-render');
    }
}
