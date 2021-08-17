@extends('layouts.master')
@section('page')
<section id="vue-non-standard-faqs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Create Faq</h4>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-primary">Back to List</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('admin.faqs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Question <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="question" value="{{ old('question') }}" placeholder="Question" />
                                    @error('question')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right"><strong>Answer</strong> <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <textarea name="answer" class="editor form-control" >{{ old('answer') }}</textarea>
                                    @error('answer')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Sort Order <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="sort_order" value="{{ old('sort_order') }}" placeholder="sort_order" />
                                    @error('sort_order')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right">Status</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="status" >
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                    @error('status')
                                    <div class="help-block text-danger"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div> --}}

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
