@extends('layouts.master')
@section('page')
<section id="vue-non-standard-testimonials">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create Testimonials</h4>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-primary">Back to List</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('admin.testimonials.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Title <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="title" />
                                    @error('title')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Image <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="file" accept="image/*" class="form-control" name="image" value="{{ old('image') }}" placeholder="image" />
                                    @error('image')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Rating <span class="text-danger">*</span> <br> <small> <i>(Between 1-5)</i> </small> </label>
                                <div class="col-md-8">
                                    <input type="number" min="1" max="5" class="form-control" name="rating" value="{{ old('rating') }}" placeholder="rating" />
                                    @error('rating')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Description <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <textarea type="text" class="form-control" name="description" placeholder="description" >{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Name <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" />
                                    @error('name')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
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
