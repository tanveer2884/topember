<?php

namespace App\Http\Livewire\Frontend\Cart;

use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BillingAndCheckout extends Component
{
    public $listeners = [
        'save-billing-shipping' => 'saveBillingAndShipping'
    ];

    public $shipping_address_id;
    public $shipping_first_name;
    public $shipping_last_name;
    public $shipping_address;
    public $shipping_city;
    public $shipping_state;
    public $shipping_zip_code;

    public $billing_address_id;
    public $billing_first_name;
    public $billing_last_name;
    public $billing_address;
    public $billing_city;
    public $billing_state;
    public $billing_zip_code;

    public $payment_id;
    public $card_number;
    public $expiry_month;
    public $expiry_year;
    public $cvc;

    public $isShippingBillingSame;

    public function mount()
    {
        $this->initializeFields();
    }

    public function render()
    {
        return view('livewire.frontend.cart.billing-and-checkout',[
            'addresses' => $this->getAddresses(),
            'payments' => collect()
        ]);
    }

    public function saveBillingAndShipping()
    {
        
        $this->validate($this->getBillingShippingRules('shipping'));

        if ( !$this->isShippingBillingSame ){
            $this->validate($this->getBillingShippingRules('billing'));
        }

        $this->validate($this->getPaymentRules());


        CartFacade::setValue('is_shipping_billing_same',$this->isShippingBillingSame);

        $this->saveShippingInfo();
        if ( !$this->isShippingBillingSame ){
            $this->saveBillingInfo();
        }

        $this->savePaymentInfo();
        
        $this->emit('alert-success','Cart Saved');
        // return redirect()->route('confirm-order');
        
    }

    public function getAddresses()
    {
        if ( !Auth::check() ){
            return collect();
        }

        return Auth::user()->addresses;
    }

    public function initializeFields()
    {
        $this->isShippingBillingSame = CartFacade::getValue('is_shipping_billing_same',true);

        $shippingAddress = CartFacade::getValue('shipping',[]);

        $billingAddress = CartFacade::getValue('billing',[]);
        $payment = CartFacade::getValue('payment',[]);


        $this->shipping_address_id = optional($shippingAddress)['address_id'];
        $this->shipping_first_name = optional($shippingAddress)['first_name'];
        $this->shipping_last_name = optional($shippingAddress)['last_name'];
        $this->shipping_address = optional($shippingAddress)['address'];
        $this->shipping_city = optional($shippingAddress)['city'];
        $this->shipping_state = optional($shippingAddress)['state'];
        $this->shipping_zip_code = optional($shippingAddress)['zip_code'];

        $this->billing_address_id = optional($billingAddress)['address_id'];
        $this->billing_first_name = optional($billingAddress)['first_name'];
        $this->billing_last_name = optional($billingAddress)['last_name'];
        $this->billing_address = optional($billingAddress)['address'];
        $this->billing_city = optional($billingAddress)['city'];
        $this->billing_state = optional($billingAddress)['state'];
        $this->billing_zip_code = optional($billingAddress)['zip_code'];

        $this->payment_id = optional($payment)['address_id'];
        $this->card_number = optional($payment)['card_number'];
        $this->expiry_month = optional($payment)['expiry_month'];
        $this->expiry_year = optional($payment)['expiry_year'];
        $this->cvc = optional($payment)['cvc'];
    }

    public function getBillingShippingRules($type)
    {
        return [
            $type.'_first_name' => 'required|max:191',
            $type.'_last_name' => 'required|max:191',
            $type.'_address' => 'required|max:191',
            $type.'_city' => 'required|max:191',
            $type.'_state' => 'required|max:191',
            $type.'_zip_code' => 'required|max:191',
        ];
    }

    public function getPaymentRules()
    {
        return [
            'card_number' => 'required',
            'expiry_month' => 'required|integer|min:1|max:12',
            'expiry_year' => 'required|integer|integer',
            'cvc' => 'required|integer|min:001|max:9999',
        ];
    }

    private function saveShippingInfo()
    {
        CartFacade::setValue('shipping',[
            'address_id' => $this->shipping_address,
            'first_name' => $this->shipping_first_name,
            'last_name' => $this->shipping_last_name,
            'address' => $this->shipping_address,
            'city' => $this->shipping_city,
            'state' => $this->shipping_state,
            'zip_code' => $this->shipping_zip_code
        ]);
    }

    private function saveBillingInfo()
    {
        CartFacade::setValue('billing',[
            'address_id' => $this->billing_address,
            'first_name' => $this->billing_first_name,
            'last_name' => $this->billing_last_name,
            'address' => $this->billing_address,
            'city' => $this->billing_city,
            'state' => $this->billing_state,
            'zip_code' => $this->billing_zip_code
        ]);
    }

    private function savePaymentInfo()
    {
        CartFacade::setValue('payment',[
            'payment_id' => $this->payment_id,
            'card_number' => $this->card_number,
            'expiry_month' => $this->expiry_month,
            'expiry_year' => $this->expiry_year,
            'cvc' => $this->cvc
        ]);
    }
}
