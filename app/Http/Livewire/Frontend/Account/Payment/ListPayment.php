<?php

namespace App\Http\Livewire\Frontend\Account\Payment;

use Livewire\Component;
use App\Models\PaymentProfile;
use Illuminate\Support\Facades\Auth;
use App\Services\Authorize\AuthorizePayment;
use Topdot\Core\Traits\WithUniqueId;

class ListPayment extends Component
{
    use WithUniqueId;

    protected $listeners = [
        'delete' => 'delete',
        're-render' => 'render',
    ];

    public function render()
    {
        return view('livewire.frontend.account.payment.list-payment',[
            'paymentProfiles' => $this->getPaymentProfiles()
        ]);
    }

    public function delete(PaymentProfile $paymentProfile)
    {
        $service = new AuthorizePayment;
        $response = $service->deletePaymentProfile(Auth::user(),$paymentProfile->payment_profile_id);

        if ( !$response->success && $response->code != 'E00040'){
            $this->emit('alert-success',$response->message);
            return;
        }

        $paymentProfile->unSetDefault()->delete();
        $this->emit('alert-success','Payment Profile Deleted Successfully');
    }

    public function getPaymentProfiles()
    {
        $query = PaymentProfile::query();

        $query->where('user_id',Auth::id());

        return $query->paginate(10);
    }
}
