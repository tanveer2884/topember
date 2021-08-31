@extends('layouts.master')
@section('page')
<section id="vue-non-standard-brands">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Tag</h4>
                    <a href="{{ route(config('cms.routeNamePrefix').'manufactures.index') }}" class="btn btn-primary">Back to List</a>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route(config('cms.routeNamePrefix').'manufactures.update',$manufacture) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $manufacture->name) }}" placeholder="Brand Name" />
                                    @error('name')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Image</label>
                                <div class="col-md-8">
                                   <livewire:temp-file-upload-component name="image" :max-files="1"/>
                                    @error('image')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                    <livewire:image-preview-component :model="$manufacture" collection="image" />
                                </div>
                            </div>

                            <div class="row mt-1 justify-content-center">
                                <div class="col-8 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
