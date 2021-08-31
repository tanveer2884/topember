<div class="specific-form">
    <form>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" wire:model.defer="email" id="exampleFormControlInput1" placeholder="Email Address">
                    @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" wire:model.defer="first_name" id="exampleFormControlInput1" placeholder="First Name">
                    @error('first_name')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control" wire:model.defer="last_name" id="exampleFormControlInput1" placeholder="Last Name">
                    @error('last_name')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <textarea type="text" class="form-control" wire:model.defer="message" id="exampleFormControlInput1" placeholder="Message"></textarea>
                    @error('message')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="cart-ship-butn div-float">
            <button type="button" class="contact-submit-butn general-btn position-relative" wire:click="submit">
                Submit
                @include('layouts.livewire.button-loading')
            </button>
        </div>
    </form>
</div>
