@extends('layouts.master')

@section('page')
<section id="product">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        Update Product
                    </h4>
                    <a href="{{ route(config('product.routeNamePrefix').'products.index') }}" class="btn btn-primary">
                        List Products
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-detail-tab" data-toggle="tab" href="#product-details" role="tab" aria-controls="product-details" aria-selected="true">
                                    Details
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active py-2" id="product-details" role="tabpanel" aria-labelledby="product-detail-tab">
                                <form action="{{ route(config('product.routeNamePrefix').'products.update',$product) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Product Name <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="name" value="{{ old('name',$product->name) }}" required class="form-control">
                                            @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Model No. <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="model_number" value="{{ old('model_number',$product->model_number) }}" required class="form-control">

                                            @error('model_number')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Slug <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="slug" value="{{ old('slug',$product->slug) }}" required class="form-control">
                                            @error('slug')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>SKU <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="sku" value="{{ old('sku',$product->sku) }}" required class="form-control">
                                            @error('sku')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Categories</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="categories[]" multiple id="" class="form-control selectpicker">
                                                <option value="">Select Categories</option>
                                                @foreach(categories() as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories',$product->categoryIds()) ) ? 'selected' :'' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger" v-if="errors.has('categories')" v-cloak>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Quantity <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="qty" value="{{ old('qty',$product->qty) }}" required class="form-control">
                                            @error('qty')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Weight <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="weight" value="{{ old('weight',$product->weight) }}" required class="form-control">
                                            @error('weight')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Price <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="price" value="{{ old('price',$product->price) }}" required class="form-control">
                                            @error('price')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>In Stock</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-control-inline custom-switch">
                                                <input type="checkbox" value="1" name="is_inStock" {{ $product->is_inStock ?'checked':'' }} class="custom-control-input" id="is_inStock">
                                                <label class="custom-control-label" for="is_inStock"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Active</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-control-inline custom-switch">
                                                <input type="checkbox" value="1" name="is_active" {{ $product->is_active ?'checked':'' }} class="custom-control-input" id="is_active">
                                                <label class="custom-control-label" for="is_active"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Featured</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-control-inline custom-switch">
                                                <input type="checkbox" value="1" name="is_featured" {{ $product->is_featured ?'checked':'' }} class="custom-control-input" id="featured">
                                                <label class="custom-control-label" for="featured"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Recommended</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-control-inline custom-switch">
                                                <input type="checkbox" value="1" name="is_recommended" {{ $product->is_recommended ?'checked':'' }} class="custom-control-input" id="recommended">
                                                <label class="custom-control-label" for="recommended"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Special Price</h4>
                                    <hr>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Special Price</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" name="special_price" value="{{ old('special_price',$product->special_price) }}" required class="form-control">
                                            @error('special_price')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Special Price start</label>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                            <input type="date" id="special_price_start_date" name="special_start_at" value="{{ old('special_start_at',$product->special_start_at_formatted) }}" class="form-control">
                                            <button class="position-absolute btn py-1 px-0" type="button" onclick="javascript:special_price_start_date.value=''" style="top: 0;right: 30px">X</button>
                                            @error('special_start_at')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Special Price End</label>
                                        </div>
                                        <div class="col-md-6 position-relative">
                                            <input type="date" id="special_end_at" name="special_end_at" value="{{ old('special_end_at',$product->special_end_at_formatted) }}" class="form-control">
                                            <button class="position-absolute btn py-1 px-0" type="button" onclick="javascript:special_end_at.value=''" style="top: 0;right: 30px">X</button>
                                            @error('special_end_at')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4>Images</h4>
                                    <hr>

                                    <div class="controls row mb-1 align-items-center">
                                        <label class="col-md-2 text-md-right">Feature Image <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <livewire:temp-file-upload-component name="feature" max-files="1" />
                                            @error('feature')
                                            <div class="help-block text-danger"> {{ $message }} </div>
                                            @enderror
                                            <livewire:image-preview-component :model="$product" collection="feature" />
                                        </div>
                                    </div>
                                    <div class="controls row mb-1 align-items-center">
                                        <label class="col-md-2 text-md-right">Additional Images <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <livewire:temp-file-upload-component max-files="4" name="additional_images" />
                                            @error('additional_images')
                                            <div class="help-block text-danger"> {{ $message }} </div>
                                            @enderror
                                            <livewire:image-preview-component :model="$product" collection="additional_images" />
                                        </div>
                                    </div>

                                    <h4>Descriptions</h4>
                                    <hr>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Short Description <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="editor" name="short_description">{{ old('short_description',$product->short_description) }}</textarea>
                                            @error('short_description')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Description <i class="text-danger">*</i></label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="editor" name="description">{{ old('description',$product->description) }}</textarea>
                                            @error('description')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4>SEO Details</h4>
                                    <hr>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Meta Title</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="meta_title" value="{{ old('meta_title',$product->meta_title) }}" class="form-control">
                                            @error('meta_title')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label>Meta Description</label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="meta_description" rows="5">{{ old('meta_description',$product->meta_description) }}</textarea>
                                            @error('meta_description')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-10 text-right">
                                            <button class="btn btn-primary" @click="updateProduct">
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