<div class="address-book-main div-flex">
    @foreach($addresses as $address)
    <div class="address-book">
        <h4>{{$address->nickname ?? ''}}
            <a href="{{route('user.addresses.edit',$address)}}">Edit</a>
        </h4>
        <p>{{$address->full_name ?? ''}} <br/>
            {{$address->address ?? ''}}, {{$address->address2 ?? ''}} <br/>
            {{$address->state ?? ''}}, {{$address->city ?? ''}} {{$address->zipCode ?? ''}} <br/>
            {{$address->country ?? ''}} <br/>
            {{$address->phone ?? ''}} <br/>
        </p>
        <p>{{$address->email ?? ''}}</p>
        <a href="javascript: void(0);" wire:click="$emit('confirmDelete','{{$address->id}}')" >Remove</a>
    </div>
    @endforeach
</div>
