@extends('layouts.master')
@section('page')
    <section id="vue-handling-services">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Profile</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route(config('core.routeNamePrefix').'profile.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                               

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input type="text"  class="form-control" name="full_name" value="{{ old('full_name',auth()->user()->name) }}" placeholder="Full Name"/>
                                        @error('full_name')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input type="text"  class="form-control" name="email" value="{{ old('email') }}" placeholder="email"/>
                                        @error('email')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password"  class="form-control" name="password" value="{{ old('password') }}" placeholder="password"/>
                                        @error('password')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password"  class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="password confirmation"/>
                                        @error('password_confirmation')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Image</label>
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*"  class="form-control" name="image" value="{{ old('image') }}" placeholder="image"/>
                                        @error('image')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                        <img src="{{ auth()->user()->getImage() }}" style="width:100px;height:100px;margin-top:20px;" alt="">
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
