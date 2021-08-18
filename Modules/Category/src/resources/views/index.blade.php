@extends('layouts.master')

@section('page')
    <section id="prealerts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            Manage Categories
                        </h4>
                        <a href="{{ route(config('category.routeNamePrefix').'categories.create')  }}" class="btn btn-primary">Create Category</a>
                    </div>
                    <div class="card-content">
                        <div class="pt-1">
                            <table class="table table-responsive-md mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    {{-- <th>Parent Category</th>
                                    <th class="text-center">Sub Categories</th> --}}
                                    <th class="text-center">Active</th>
                                    <th>
                                        Created At
                                    </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        {{-- <td>
                                            {{ optional($category->parentCategory)->name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $category->sub_categories_count }}
                                        </td> --}}
                                        <td class="text-center">
                                            @if ($category->isActive())
                                                <i>Active</i>
                                            @else
                                                <i>In Active</i>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $category->created_at->format('m-d-Y g:i:s a') }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right dropright">

                                                        <a href="{{ route(config('category.routeNamePrefix').'categories.show',$category) }}" title="View Category" class="dropdown-item w-100">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>

                                                        <a href="{{ route(config('category.routeNamePrefix').'categories.edit',$category) }}" title="Edit Category" class="dropdown-item w-100">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>

                                                        <form action="{{ route(config('category.routeNamePrefix').'categories.destroy',$category) }}" class="d-flex" method="post" onsubmit="return confirmDelete()">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item w-100 text-danger">
                                                                <i class="feather icon-trash-2"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end px-2 mx-2 my-2">
                                {{ $categories->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
