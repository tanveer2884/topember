@extends('layouts.master')
@section('page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"> <strong>Category: </strong> {{ $category->name }}</h4>
                        <a href="{{ route(config('category.routeNamePrefix').'categories.index') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <hr>
                    <div class="card-content">
                        <div class="card-body">
                            <h5 class="border-bottom pb-1">Sub Categories</h5>
                            <ol>
                                @forelse($category->subCategories as $cat)
                                    <li>{{ $cat->name }}</li>
                                @empty
                                <p class="text-warning">No Sub Categories</p>
                                @endforelse
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
