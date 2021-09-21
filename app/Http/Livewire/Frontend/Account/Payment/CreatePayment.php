<?php

namespace App\Http\Livewire\Frontend\Account\Payment;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Utils\CardDetector;
use App\Models\PaymentProfile;
use App\Rules\DateEqualGreaterThen;
use Illuminate\Support\Facades\Auth;
use App\Services\Authorize\AuthorizePayment;

class CreatePayment extends Component
{

    public $name;
    public $card_number;
    public $cvc;
    public $expiry_date;
    public $default;
    public $cardType;

    public function render()
    {
        return view('livewire.frontend.account.payment.create-payment');
    }

    public function savePayment()
    {
        $user = Auth::user();
        if (
            !$user->name || !$user->last_name ||
            !$user->address || !$user->city ||
            !$user->state || !$user->zipCode ||
            !$user->phone
        ) {
            session()->flash('alert-danger', 'Please complete your profile info to add payments');
            return redirect()->route('user.my-account');
        }
        $data = $this->validate([
            'name' => 'required|max:191',
            'card_number' => 'required|max:20',
            'cvc' => 'required|numeric|digits_between:3,4',
            'expiry_date' => [
                'required',
                'date_format:Y-m',
                new DateEqualGreaterThen(Carbon::now())
            ],
        ]);

        $this->detectCardType();

        if (!$this->cardType) {
            $this->addError('card_number', 'Invalid Card Number');
            return;
        }

        try {
            $service = new AuthorizePayment;
            if (Auth::user()->getAuthorizePaymentProfileId()) {
                $response = $service->addPaymentProfileToCustomerProfile(Auth::user(), $data);
                if (!$response->success) {
                    $this->emit('alert-danger', $response->message);
                    return;
                }

                $this->addPaymentToDatabase($response->data['paymentProfileId']);
                $this->emit('alert-success', 'Payment Profile created Successfully');
                return;
            }

            $response = $service->createCustomerProfileWithPaymentProfile(Auth::user(), $data);

            if (!$response->success) {
                $this->emit('alert-danger', $response->message);
                return;
            }

            Auth::user()->setAuthorizePaymentProfileId($response->data['customerProfile']);
            $this->addPaymentToDatabase($response->data['paymentProfileId']);
            $this->emit('alert-success', 'Payment Profile created Successfully');
            session()->flash('alert-success', 'Payment Profile created Successfully');
            return redirect()->route('user.payments.index');
        } catch (Exception $ex) {
            $this->emit('alert-danger', $ex->getMessage());
            return;
        }
    }

    private function addPaymentToDatabase($paymentProfileId)
    {
        $cardLastDigits = substr(cleanString($this->card_number), -4);
        $paymentProfile = PaymentProfile::create([
            'user_id' => Auth::id(),
            'payment_profile_id' => $paymentProfileId,
            'name' => $this->name,
            'card_last' => $cardLastDigits,
            'expiry' => $this->expiry_date,
            'card_type' => $this->cardType
        ]);

        if ($this->default) {
            $paymentProfile->setDefault();
        }

        $this->initializeFields();
        return $paymentProfile;
    }

    public function detectCardType()
    {
        $cardDetector = new CardDetector;
        switch (cleanString($this->card_number)) {
            case $cardDetector->isVisa(cleanString($this->card_number)):
                $this->cardType = 'visa';
                break;

            case $cardDetector->isMasterCard(cleanString($this->card_number)):
                $this->cardType = 'master';
                break;

            case $cardDetector->isAmex(cleanString($this->card_number)):
                $this->cardType = 'American Express';
                break;

            case $cardDetector->isDiscover(cleanString($this->card_number)):
                $this->cardType = 'discover';
                break;

            case $cardDetector->isJCB(cleanString($this->card_number)):
                $this->cardType = 'jcb';
                break;

            case $cardDetector->isDinersClub(cleanString($this->card_number)):
                $this->cardType = 'dinnersClub';
                break;

            default:
                $this->cardType = null;
                break;
        }
    }

    public function initializeFields()
    {
        $this->card_number = '';
        $this->cvc = '';
        $this->expiry_date = '';
        $this->name = '';
        $this->default = false;
        $this->cardType = null;
    }
}
