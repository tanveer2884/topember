@extends('layouts.master')

@section('page')
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        Edit Attribute
                    </h4>
                    <a href="{{ route(config('product.routeNamePrefix').'attributes.index') }}" class="btn btn-primary">
                        List Attributes
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <hr>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active py-2" id="attribute-details" role="tabpanel" aria-labelledby="attribute-detail-tab">
                                <form action="{{ route(config('product.routeNamePrefix').'attributes.update',$attribute) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Name <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="name" value="{{ old('name',$attribute->name) }}" required class="form-control">
                                            @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col-md-10 text-right">
                                            <button class="btn btn-primary">
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
        </div>
    </div>
</section>
@endsection