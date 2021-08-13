@extends('layouts.master')
@section('page')
<section id="vue-create-coupon">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Coupon</h4>
                    <a href="{{ route(config('coupon.routeNamePrefix').'coupons.index') }}" class="btn btn-primary">Back to List</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route(config('coupon.routeNamePrefix').'coupons.update',$coupon) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right"><strong>Name</strong> <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name" value="{{ old('name',$coupon->name) }}" placeholder="Name" />
                                    @error('name')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right"><strong>Code</strong> <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="code" value="{{ old('code',$coupon->code) }}" placeholder="Code" />
                                    @error('code')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 text-md-right"><strong>Discount Type</strong>
                                </label>
                                <div class="col-md-6">
                                    <div class="custom-control custom-control-inline custom-switch">
                                        <input type="checkbox" value="1" name="discount_is_percent" {{ old('discount_is_percent',$coupon->discount_is_percent) ? 'checked':'' }} class="custom-control-input" id="is_percent">
                                        <span class="d-inline-block mx-1">Fixed</span>
                                        <label class="custom-control-label" for="is_percent"></label>
                                        <span class="d-inline-block mx-1">Percent</span>
                                    </div>
                                    @error('discount_is_percent')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right"><strong>Value</strong> <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="number" id="coupon-value" class="form-control" name="value" value="{{ old('value',$coupon->value) }}" placeholder="Value" />
                                    @error('value')
                                    <div class="help-block text-danger" id="coupon-error">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 text-md-right"><strong>Free Shipping</strong>
                                </label>
                                <div class="col-md-6">
                                    <div class="custom-control custom-control-inline custom-switch">
                                        <input type="checkbox" name="is_free_shipping" {{ old('is_free_shipping',$coupon->is_free_shipping) ?'checked':'' }} class="custom-control-input" id="is_free_shipping">
                                        <label class="custom-control-label" for="is_free_shipping"></label>
                                    </div>
                                    @error('is_free_shipping')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right"><strong>Start Date</strong> <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8 position-relative">
                                    <input type="date" name="start_at" value="{{ old('start_at',$coupon->start_at_formatted) }}" class="form-control" id="start_at">
                                    <button class="position-absolute btn py-1 px-0" type="button" onclick="javascript:start_at.value=''" style="top: 0;right: 30px">X</button>
                                    @error('start_at')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="controls row mb-1 align-items-center">
                                <label class="col-md-2 text-md-right"><strong>End Date</strong> <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8 position-relative">
                                    <input type="date" name="end_at" value="{{ old('end_at',$coupon->end_at_formatted) }}" class="form-control" id="end_at">
                                    <button class="position-absolute btn py-1 px-0" type="button" onclick="javascript:end_at.value=''" style="top: 0;right: 30px">X</button>
                                    @error('end_at')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row form-group">
                                <label class="col-md-2 text-md-right"><strong>Active</strong>
                                </label>
                                <div class="col-md-6">
                                    <div class="custom-control custom-control-inline custom-switch">
                                        <input type="checkbox" name="is_active" {{ old('is_active',$coupon->is_active) ? 'checked' :'' }} class="custom-control-input" id="is_active">
                                        <label class="custom-control-label" for="is_active"></label>
                                    </div>
                                    @error('is_active')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <label class="col-md-2 text-md-right"><strong>Site Wide</strong>
                                </label>
                                <div class="col-md-6">
                                    <div class="custom-control custom-control-inline custom-switch">
                                        <input type="checkbox" name="is_site_wide" {{ old('is_site_wide',$coupon->is_site_wide) ? 'checked' :'' }} class="custom-control-input" id="is_site_wide">
                                        <label class="custom-control-label" for="is_site_wide"></label>
                                    </div>
                                    @error('is_site_wide')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="mt-4 d-block">Usage Restrictions</h4>
                            <hr>
                            <div class="row form-group">
                                <label class="col-md-2 text-md-right"><strong>Products</strong>
                                </label>
                                <div class="col-md-8">
                                    <select name="products[]" class="form-control selectpicker" multiple>
                                        <option value="">Select Products</option>
                                        @foreach($allProducts as $product)
                                        <option value="{{ $product->id }}" {{ in_array($product->id,old('products',$coupon->products)) ? 'selected':'' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('products')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-md-2 text-md-right"><strong>Exclude Products</strong>
                                </label>
                                <div class="col-md-8">
                                    <select name="excludeProducts[]" class="form-control selectpicker" multiple>
                                        <option value="">Select Products</option>
                                        @foreach($allProducts as $product)
                                        <option value="{{ $product->id }}" {{ in_array($product->id,old('excludeProducts',$coupon->excludeProducts)) ? 'selected':'' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('excludeProducts')
                                    <div class="help-block text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{--
                        <div class="row form-group">
                            <label class="col-md-2 text-md-right"><strong>Categories</strong>
                            </label>
                            <div class="col-md-8">
                                <select name="categories[]" class="form-control selectpicker" multiple>
                                    <option value="">Select Products</option>
                                    @foreach($allCategories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id,old('categories',$coupon->categories)) ? 'selected':'' }}>{{ $category->name }}</option>
                            @endforeach
                            </select>
                            @error('categories')
                            <div class="help-block text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-2 text-md-right"><strong>Exclude Categories</strong>
                    </label>
                    <div class="col-md-8">
                        <select name="excludeCategories[]" class="form-control selectpicker" multiple>
                            <option value="">Select Products</option>
                            @foreach($allCategories as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id,old('excludeCategories',$coupon->excludeCategories)) ? 'selected':'' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('excludeCategories')
                        <div class="help-block text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                --}}
                <div class="row form-group">
                    <label class="col-md-2 text-md-right"><strong>Users</strong>
                    </label>
                    <div class="col-md-8">
                        <select name="users[]" class="form-control selectpicker" multiple>
                            <option value="">Select Products</option>
                            @foreach($allUsers as $user)
                            <option value="{{ $user->id }}" {{ in_array($user->id,old('users',$coupon->users)) ? 'selected':'' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('users')
                        <div class="help-block text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="row mt-1 justify-content-center">
                    <div class="col-8 d-flex flex-sm-row flex-column justify-content-end mt-1">
                        <button class="btn save-btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">
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

@push('js')

<script>
    $(function() {
        $('#coupon-value').on('keyup', function() {
            $('#coupon-error').remove();
            if (!$('#is_percent').prop('checked')) {
                return;
            }

            if ( $(this).val() <= 99.99) {
                return;
            }

            if ( ! document.getElementById('coupon-error') ){
                $(`<div class="help-block text-danger" id="coupon-error">
                                            Value Cannot be geater then 99.99%
                                        </div>`).insertAfter('#coupon-value');
            }

            $(this).val(0)
        })
    })
</script>

@endpush