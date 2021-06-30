@extends('layouts.master')
@section('page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Create Category</h4>
                        <a href="{{ route(config('category.routeNamePrefix').'categories.index') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route(config('category.routeNamePrefix').'categories.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text"  class="form-control" name="name" value="{{ old('name') }}" placeholder="Name"/>
                                        @error('name')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Image <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <livewire:temp-file-upload-component name="default" max-files="1" />
                                        @error('default')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Parent</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="parent" >
                                            <option value="">Select Parent</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}" {{ old('parent') == $cat->id ? 'selected' :'' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Status</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="status" >
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Disabled</option>
                                        </select>
                                        @error('status')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Featured</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="is_featured" >
                                            <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ old('is_featured') == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('is_featured')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-1 justify-content-center">
                                    <div class="col-6 d-flex flex-sm-row flex-column justify-content-end mt-1">
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
