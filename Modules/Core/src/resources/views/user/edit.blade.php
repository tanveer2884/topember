@extends('layouts.master')
@section('page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit User</h4>
                        <a href="{{ route(config('core.routeNamePrefix').'users.index') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route(config('core.routeNamePrefix').'users.update',$user) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text"  class="form-control" name="name" value="{{ old('name',$user->name) }}" placeholder="Name"/>
                                        @error('name')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Email <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text"  class="form-control" name="email" value="{{ old('email',$user->email) }}" placeholder="Email"/>
                                        @error('email')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password"  class="form-control" name="password" placeholder="Password"/>
                                        @error('password')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password"  class="form-control" name="password_confirmation" placeholder="Confirm Password"/>
                                        @error('password_confirmation')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-1 justify-content-center">
                                    <div class="col-6 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">
                                            Update
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
