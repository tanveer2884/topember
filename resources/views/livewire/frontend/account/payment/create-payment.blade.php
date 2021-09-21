<div action="#" name="add-payments-frm">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="cn" wire:model.defer="card_number" placeholder="Card Number" class="form-control" />
                    <label class="form-control-placeholder" for="cn">
                        <span class="floating-text">Card Number</span>
                    </label>
                </div>
                @error('card_number')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="unamecard" wire:model.defer="name" placeholder="Name On Card" class="form-control" />
                    <label class="form-control-placeholder" for="unamecard">
                        <span class="floating-text">Name On Card</span>
                    </label>
                </div>
                @error('name')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="cd" wire:model.defer="expiry_date" placeholder="YYYY-MM" class="form-control no-arrow"  />
                    <label class="form-control-placeholder" for="cd">
                        <span class="floating-text">YYYY-MM</span>
                    </label>
                </div>
                @error('expiry_date')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group cvc-field">
                <div class="floating-labels">
                    <input type="text" id="ucvc" placeholder="CVC" wire:model.defer="cvc" class="form-control" maxlength="4" oninput="this.value=this.value.slice(0,this.maxLength)" />
                    <label class="form-control-placeholder" for="ucvc">
                        <span class="floating-text">CVC</span>
                    </label>
                </div>
                <div class="whats-this">
                    <span><img src="/images/whats.png" class="img-fluid" alt=""> What's This? </span>
                    <div class="cvc-img"></div>
                </div>
                @error('cvc')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="address-check-wrap div-float">

                <div class="checkbox-row">
                    <label class="cc-chekcout">
                        <input id="bill-chk" wire:model.defer="default" type="checkbox" checked="checked">
                        <span class="cc-chekmark"></span>
                    </label>
                    <span>Default Payment Option</span>
                </div>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="button" wire:click="savePayment" class="general-btn w-100 position-relative">
                    Submit
                    @include('layouts.livewire.button-loading')
                </button>
            </div>
        </div>
    </div>
</div>
