<div class="profile-description">
    <div class="account-form">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" wire:model.defer="nickname" class="form-control" placeholder="Address Name Here" />
                    @error('nickname')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="first_name" class="form-control" placeholder="First Name" />
                    @error('first_name')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="last_name" class="form-control" placeholder="Last Name" />
                    @error('last_name')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="email" wire:model.defer="email" class="form-control" placeholder="Email" />
                    @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="tel" wire:model.defer="phone" class="form-control" placeholder="Phone" />
                    @error('phone')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="address" class="form-control" placeholder="Address 1" />
                    @error('address')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="address2" class="form-control" placeholder="Address 2" />
                    @error('address2')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select wire:model.defer="country" id="" class="form-control">
                        <option value="">Select Country</option>
                        <option value="USA"> United States </option>
                    </select>
                    @error('country')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <select wire:model.defer="state" id="" class="form-control">
                        <option value="">Select Country</option>
                        @foreach(states(['code','name']) as $state)
                            <option value="{{ $state->code }}"> {{ $state->name }} </option>
                        @endforeach
                    </select>
                    @error('state')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="city" class="form-control" placeholder="City" />
                    @error('city')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" wire:model.defer="zipCode" class="form-control" placeholder="Zip" />
                    @error('zipCode')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="general-btn mt-2" wire:click="submit">
                    Submit
                    @include('layouts.livewire.button-loading')
                </button>
            </div>
        </div>
    </div>
</div>

