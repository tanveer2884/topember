<div>
    <div class="controls row mb-1 align-items-center">
        <label class="col-md-2 text-md-right">Title <span class="text-danger">*</span></label>
        <div class="col-md-8">
            <input type="text"  class="form-control" name="title" wire:model.debounce.400ms="title" placeholder="Title"/>
            @error('title')
            <div class="help-block text-danger"> {{ $message }} </div>
            @enderror
        </div>
    </div>

    <div class="controls row mb-1 align-items-center">
        <label class="col-md-2 text-md-right">Slug @if($required) <span class="text-danger">*</span> @endif  </label>
        <div class="col-md-8">
            <input type="text"  class="form-control" name="slug" wire:model="slug" value="{{ old('slug') }}" placeholder="Slug"/>
            @error('slug')
            <div class="help-block text-danger"> {{ $message }} </div>
            @enderror
        </div>
    </div>
</div>
