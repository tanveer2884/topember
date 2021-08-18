<div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="ufedtax" wire:model.defer="tax_id" placeholder="Federal Tax ID" class="form-control" />
                    <label class="form-control-placeholder" for="ufedtax">
                        <span class="floating-text">Federal Tax ID</span>
                    </label>
                </div>
                @error('tax_id')
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
                    <input type="text" id="ufirstname" wire:model.defer="first_name" placeholder="First Name" class="form-control" />
                    <label class="form-control-placeholder" for="ufirstname">
                        <span class="floating-text">First Name</span>
                    </label>
                </div>
                @error('first_name')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="ulastname" wire:model.defer="last_name" placeholder="Last Name" class="form-control" />
                    <label class="form-control-placeholder" for="ulastname">
                        <span class="floating-text">Last Name</span>
                    </label>
                </div>
                @error('last_name')
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
                    <input type="email" id="uemail" wire:model.defer="email" placeholder="Email" class="form-control" />
                    <label class="form-control-placeholder" for="uemail">
                        <span class="floating-text">Email</span>
                    </label>
                </div>
                @error('email')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="phone" wire:model.defer="phone" placeholder="Phone" class="form-control" />
                    <label class="form-control-placeholder" for="phone">
                        <span class="floating-text">Phone</span>
                    </label>
                </div>
                @error('phone')
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
                    <input type="text" id="uaddress1" wire:model.defer="address" placeholder="Address 1" class="form-control" />
                    <label class="form-control-placeholder" for="uaddress1">
                        <span class="floating-text">Address 1</span>
                    </label>
                </div>
                @error('address')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="uaddress2" wire:model.defer="address2" placeholder="Address 2" class="form-control" />
                    <label class="form-control-placeholder" for="uaddress2">
                        <span class="floating-text">Address 2</span>
                    </label>
                </div>
               @error('address2')
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
                    <input type="text" id="ucountry" wire:model.defer="country" placeholder="Country" class="form-control" />
                    <label class="form-control-placeholder" for="ucountry">
                        <span class="floating-text">Country</span>
                    </label>
                </div>
                @error('country')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="ucity" wire:model.defer="city" placeholder="City" class="form-control" />
                    <label class="form-control-placeholder" for="ucity">
                        <span class="floating-text">City</span>
                    </label>
                </div>
                @error('city')
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
                    <select placeholder="State" wire:model.defer="state" id="stateustate" class="form-control">
                        <option value="">Select State</option>
                        @foreach(states(['code','name']) as $state)
                        <option value="{{ $state->code }}"> {{ $state->name }} </option>
                        @endforeach
                    </select>
                    <label class="form-control-placeholder" for="ustate">
                        <span class="floating-text">State</span>
                    </label>
                </div>
                @error('state')
                <div class="error-class">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="floating-labels">
                    <input type="text" id="uzip" wire:model.defer="zipCode" placeholder="Zip Code" class="form-control" />
                    <label class="form-control-placeholder" for="uzip">
                        <span class="floating-text">Zip Code</span>
                    </label>
                </div>
                @error('zipCode')
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
                <button type="submit" class="general-btn w-100 position-relative" wire:click="register">
                    Submit
                    @include('layouts.livewire.button-loading')
                </button>
            </div>
        </div>
    </div>
</div>
