<div>
    <div class="input-group">
        <input type="text" class="form-control" wire:model.defer="coupon" placeholder="Discount Code">
        <div class="input-group-append">
            @if (!$couponApplied)
                <button class="btn general-btn imp-btn-new" wire:click="applyCoupon" type="submit">Apply</button>
            @else
                <button class="btn btn-danger general-btn imp-btn-new" wire:click="removeCoupon" type="submit">x</button>
            @endif
        </div>
        @error('coupon')
            <div class="error mb-1">{{ $message }}</div>
        @enderror
    </div>
</div>