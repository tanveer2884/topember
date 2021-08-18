<div class="div-float acc-rb-inner">
    <div class="div-float address-book-wrap">
        <div class="div-float address-section">
            <div class="div-float add-sec-label">
                <h3>Default Addresses</h3>
            </div>
            <div class="div-float add-sub-sec">
                <div class="row">
                    @if( $address = auth()->user()->getDefaultShippingAddress(true) )
                    <div class="col-md-6">
                        <div class="div-float add-box-wrap">

                            <div class="div-float addbox-hdr">
                                <h4>Default Shipping{{ $address->isDefaultBillingAndShipping() ? "/Billing" :'' }} Address</h4>
                                <div class="add-right-links">
                                    <a href="{{ route('user.addresses.edit',$address) }}">Edit</a>
                                    <a href="javascript:void(0)" wire:click="$emit('confirmDelete','{{$address->id}}')">Delete</a>
                                </div>
                            </div>

                            <div class="div-float addbox-content qa-bold">
                                <span>{{ $address->name }} {{ $address->last_name }}</span>
                                <p>{{ $address->address }} , {{ $address->address2 }}</p>
                                <p> {{ $address->state }}, {{ $address->city }} {{ $address->zipCode }}</p>
                                <p>United States</p>
                                <p>{{ $address->phone }}</p>
                                <p>&nbsp;</p>
                                <p>{{ $address->email }}</p>
                            </div>

                        </div>
                    </div>
                    @endif

                    @if( ($address = auth()->user()->getDefaultBillingAddress(true)) && $address->id != auth()->user()->getDefaultShippingAddress())
                    <div class="col-md-6">
                        <div class="div-float add-box-wrap">

                            <div class="div-float addbox-hdr">
                                <h4>Default Billing Address</h4>
                                <div class="add-right-links">
                                    <a href="{{ route('user.addresses.edit',$address) }}">Edit</a>
                                    <a href="javascript:void(0)" wire:click="$emit('confirmDelete','{{$address->id}}')">Delete</a>
                                </div>
                            </div>

                            <div class="div-float addbox-content qa-bold">
                                <span>{{ $address->name }} {{ $address->last_name }}</span>
                                <p>{{ $address->address }} , {{ $address->address2 }}</p>
                                <p> {{ $address->state }}, {{ $address->city }} {{ $address->zipCode }}</p>
                                <p>United States</p>
                                <p>{{ $address->phone }}</p>
                                <p>&nbsp;</p>
                                <p>{{ $address->email }}</p>
                            </div>

                        </div>
                    </div>
                    @endif

                    <div class="col-md-12">
                        @if( !auth()->user()->getDefaultShippingAddress() && !auth()->user()->getDefaultBillingAddress())
                        <h4 class="text-center">No Default Address</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="div-float address-section">


            <div class="div-float add-sec-label">
                <h3>Additional Addresses</h3>
            </div>


            <div class="div-float add-sub-sec">
                <div class="row">

                    @forelse($addresses as $address)
                    <div class="col-md-6">
                        <div class="div-float add-box-wrap">

                            <div class="div-float addbox-hdr">
                                <h4>{{ $address->name }} {{ $address->last_name }}</h4>
                                <div class="add-right-links">
                                    <a href="{{ route('user.addresses.edit',$address) }}">Edit</a>
                                    <span>|</span>
                                    <a href="javascript:void(0)" wire:click="$emit('confirmDelete','{{$address->id}}')">Delete</a>
                                </div>
                            </div>

                            <div class="div-float addbox-content">
                                <p>{{ $address->address }} , {{ $address->address2 }}</p>
                                <p> {{ $address->state }}, {{ $address->city }} {{ $address->zipCode }}</p>
                                <p>United States</p>
                                <p>{{ $address->phone }}</p>
                                <p>&nbsp;</p>
                                <p>{{ $address->email }}</p>
                            </div>

                        </div>
                    </div>
                    @empty
                    <div class="col-md-12 text-center">
                        <h4 class="text-center">No Addresses Found</h4>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
