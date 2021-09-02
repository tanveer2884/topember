<div>
    <div class="billing-main-heading pt-3 div-float">
        <h2 class="shipping-main-head-style div-float">Shipping Information</h2>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        @if (auth()->check() && $addresses->isNotEmpty())
            <div class="col-sm-12">
                <div class="form-group">
                    <!-- <label for="exampleFormControlSelect1">select from save adress</label> -->
                    <select wire:model.defer="shipping_address_id" wire:change="selectShipping" class="form-control" id="exampleFormControlSelect1">
                        <option>Select from saved addresses</option>
                        @foreach ($addresses as $address)
                            <option value="{{ $address->id }}"> {{ $address->nickname }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" wire:model.defer="shipping_first_name" class="form-control" placeholder="First Name">
                @error('shipping_first_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" wire:model.defer="shipping_last_name" class="form-control" placeholder="Last Name">
                @error('shipping_last_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="email" wire:model.defer="shipping_email" class="form-control" placeholder="Email">
                @error('shipping_email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" wire:model.defer="shipping_phone" class="form-control phone_number" placeholder="Phone">
                @error('shipping_phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" wire:model.defer="shipping_address" class="form-control" placeholder="Address">
                @error('shipping_address')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" wire:model.defer="shipping_city" class="form-control" placeholder="City">
                @error('shipping_city')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <select wire:model.defer="shipping_state" class="form-control">
                    @foreach (states() as $state)
                    <option value="{{ $state->code }}"> {{ $state->code }} </option>
                    @endforeach
                </select>
                @error('shipping_state')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" wire:model.defer="shipping_zip_code" class="form-control" maxlength="5" placeholder="Zip Code">
                @error('shipping_zip_code')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <!-- check-box -->
    <div class="my-cart-check-box pt-3 pl-3 mb-3 div-float">
        <div class="form-group ch-box-1">
            <input type="checkbox" {{ $isShippingBillingSame ? 'checked' : '' }} wire:click="$emit('toggleBilling',$event.target)" id="html">
            <label for="html">Same as Shipping</label>
        </div>
    </div>

    <div class="billing-form-main {{ $isShippingBillingSame ? 'd-none' : '' }}" id="billing-form">
        <!-- billing-information -->
        <div class="billing-main-heading pt-3 div-float">
            <h2 class="shipping-main-head-style div-float">Billing Information</h2>
        </div>

        <!-- billing-form -->
        <div class="row div-float">
            @if (auth()->check() && $addresses->isNotEmpty())
                <div class="col-sm-12">
                    <div class="form-group">
                        <select wire:model.defer="billing_address_id" wire:change="selectBilling" class="form-control" id="">
                            <option>Select from saved addresses</option>
                            @foreach ($addresses as $address)
                                <option value="{{ $address->id }}"> {{ $address->nickname }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="billing_first_name" class="form-control" placeholder="First Name">
                    @error('billing_first_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="billing_last_name" class="form-control" placeholder="Last Name">
                    @error('billing_last_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="email" wire:model.defer="billing_email" class="form-control" placeholder="Email">
                    @error('billing_email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="billing_phone" class="form-control phone_number" placeholder="Phone">
                    @error('billing_phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" wire:model.defer="billing_address" class="form-control" placeholder="Address">
                    @error('billing_address')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text" wire:model.defer="billing_city" class="form-control" placeholder="City">
                    @error('billing_city')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <select wire:model.defer="billing_state" class="form-control">
                        @foreach (states() as $state)
                        <option value="{{ $state->code }}"> {{ $state->code }} </option>
                        @endforeach
                    </select>
                    @error('billing_state')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text" wire:model.defer="billing_zip_code" maxlength="5" class="form-control" placeholder="Zip Code">
                    @error('billing_zip_code')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <!-- payment-information -->
    <div class="billing-main-heading pt-3 div-float">
        <h2 class="shipping-main-head-style  div-float">Payment information</h2>
    </div>
    <!-- billing-form -->
    <div class="row div-float">
        @if (auth()->check() && $payments->isNotEmpty())
            <div class="col-sm-12">
                <div class="form-group">
                    <select wire:model.defer="payment.payment_id" class="form-control">
                        <option>select from save payment</option>
                        @foreach ($payments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" wire:model.defer="card_number" class="card_number form-control" placeholder="Credit Card Number">
                @error('card_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" wire:model.defer="expiry_month" class="form-control month" placeholder="Exp Month">
                @error('expiry_month')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" wire:model.defer="expiry_year" class="form-control year" placeholder="Exp Year">
                @error('expiry_year')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" wire:model.defer="cvc" class="form-control" maxlength="4" placeholder="CVC">
                @error('cvc')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    {{-- {{ dd(Cart::getExtraData()) }} --}}
</div>


@push('page_js')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('toggleBilling', function(input) {
                console.log('called')
                if ($(input).prop('checked')) {
                    @this.set('isShippingBillingSame', true, true)
                    $('#billing-form').addClass('d-none');
                } else {
                    @this.set('isShippingBillingSame', false, true)
                    $('#billing-form').removeClass('d-none');
                }
            })
        })
    </script>
@endpush
