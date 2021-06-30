<div>
    <label for="order-status">Order Status</label>
    <select class="form-control" wire:model="status" id="order-status">
        @foreach($statuses as $key => $status)
        <option value="{{$key}}">{{ $status }}</option>
        @endforeach
    </select>
</div>