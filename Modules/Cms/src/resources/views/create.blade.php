@extends('layouts.master')
@section('page')
<section id="vue-non-standard-pages">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create Page</h4>
                    <a href="{{ route(config('cms.routeNamePrefix').'pages.index') }}" class="btn btn-primary">Back to List</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route(config('cms.routeNamePrefix').'pages.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <livewire:slug-generator />


                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Meta Title</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Page Slug" />
                                    @error('meta_title')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Meta Description</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="meta_description" value="{{ old('meta_description') }}" placeholder="Page Meta Description" />
                                    @error('meta_description')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Raw Meta</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="meta" placeholder="Page Raw Meta" cols="30" rows="10">{{ old('meta') }}</textarea>
                                    @error('meta')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Status</label>
                                <div class="col-md-8">
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>In-Active</option>
                                    </select>
                                    @error('status')
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
