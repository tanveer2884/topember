@extends('layouts.master')
@section('page')
    <section id="vue-handling-services" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Settings</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route(config('core.routeNamePrefix').'settings.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h5 class="mt-4">General Settings</h5>
                                <hr>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Site Title
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('site_title',getGeneralSetting('site_title')) }}" name="site_title" placeholder="Site Title">
                                        @error('site_title')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Site Logo
                                    </label>
                                    <div class="col-md-6">
                                        <input type="file" accept="image/*" class="form-control" value="{{ old('site_logo',getGeneralSetting('site_logo')) }}" name="site_logo" placeholder="Site Logo">
                                        @error('site_logo')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                        @if (getGeneralSetting('site_logo'))
                                            <img src="{{ getGeneralSetting('site_logo') }}" style="width: 100px; height: 100px;" alt="{{ getGeneralSetting('site_title') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Copy Right Text
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('copyright_text',getGeneralSetting('copyright_text')) }}" name="copyright_text" placeholder="Copy Right Text">
                                        @error('copyright_text')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <h5 class="mt-4">Contact Information</h5>
                                <hr>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Store Email
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('store_contact_email',getGeneralSetting('store_contact_email')) }}" name="store_contact_email" placeholder="Email">
                                        @error('store_contact_email')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Phone
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('store_contact_phone',getGeneralSetting('store_contact_phone')) }}" name="store_contact_phone" placeholder="Phone">
                                        @error('store_contact_phone')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Address
                                    </label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="store_contact_address" placeholder="Address">{{ old('store_contact_address',getGeneralSetting('store_contact_address')) }}</textarea>
                                        @error('store_contact_address')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <h5 class="mt-4">Social Links</h5>
                                <hr>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Facebook Url
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('facebook_url',getGeneralSetting('facebook_url')) }}" name="facebook_url" placeholder="Facebook Profile Link">
                                        @error('facebook_url')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Twitter Url
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('twitter_url',getGeneralSetting('twitter_url')) }}" name="twitter_url" placeholder="Twitter Profile Link">
                                        @error('twitter_url')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Linked In Url
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('linkedin_url',getGeneralSetting('linkedin_url')) }}" name="linkedin_url" placeholder="Linkedin Profile Link">
                                        @error('linkedin_url')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Instagram Url
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('instagram_url',getGeneralSetting('instagram_url')) }}" name="instagram_url" placeholder="Instagram Profile Link">
                                        @error('instagram_url')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <h5 class="mt-4">Other Settings</h5>
                                <hr>
                                {{--<div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Timezone
                                    </label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="timezone">
                                            <option value="" hidden>Select Timezone</option>
                                            @foreach (config('timezones') as $key => $timezone)
                                                <option value="{{ $key }}" {{ $key== auth()->user()->getTimezone() ?'selected':'' }}> {{ $timezone }} </option>
                                            @endforeach
                                        </select>
                                        @error('timezone')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>--}}

                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Contact Us Email
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ old('contact_us_email',getGeneralSetting('contact_us_email')) }}" name="contact_us_email" placeholder="Contact Us email">
                                        @error('contact_us_email')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">
                                            Save Changes
                                        </button>
                                        <button type="reset" class="btn btn-outline-warning waves-effect waves-light">Reset</button>
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
