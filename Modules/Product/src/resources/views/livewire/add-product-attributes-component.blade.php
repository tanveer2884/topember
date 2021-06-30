<div class="position-relative">
    <hr>
    <div class="row">
        <div class="col-md-4">
            <select name="" wire:model="attribute" class="form-control" id="">
                <option value="">Select Attribute</option>
                @foreach ($this->attributes() as $attribute)
                    <option value="{{$attribute->id}}">{{ $attribute->name }}</option>
                @endforeach
            </select>
            @error('attribute')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <select multiple wire:model.defer="attributeValues" class="form-control" id="">
                <option value="">Select Attribute Values</option>
                @foreach ($this->attributeValues() as $attributeValue)
                    <option value="{{$attributeValue->id}}">{{ $attributeValue->name }}</option>
                @endforeach
            </select>

            @error('attributeValues')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" wire:click="submit">Add</button>
        </div>
    </div>
    @include('layouts.livewire.loading')
</div>