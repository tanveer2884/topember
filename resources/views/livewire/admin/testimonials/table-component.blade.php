<div class="pt-1 position-relative">
    <div class="row p-2">
        <div class="col-md-4">
            <input class="form-control" placeholder="Search..." type="search" wire:model.debounce.500ms="search">
        </div>
    </div>
    <table class="table table-responsive-md mb-0">
        <thead>
        <tr>
            {{-- <th>
                Image
            </th> --}}
            <th>
                <a href="javascript:void(0);" wire:click="sort('title')">
                    Ttile
                </a>
                @if ($orderBy == 'title')
                    {!! $sortArrow !!}
                @endif
            </th>
            {{-- <th>
                <a href="javascript:void(0);" wire:click="sort('rating')">
                    Rating
                </a>
                @if ($orderBy == 'rating')
                    {!! $sortArrow !!}
                @endif
            </th> --}}
            <th>
                Description
            </th>
            <th>
                <a href="javascript:void(0);" wire:click="sort('name')">
                    Name
                </a>
                @if ($orderBy == 'name')
                    {!! $sortArrow !!}
                @endif
            </th>
            <th>
                <a href="javascript:void(0);" wire:click="sort('created_at')">
                    Created At
                </a>
                @if ($orderBy == 'created_at')
                    {!! $sortArrow !!}
                @endif
            </th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($testimonials as $testimonial)
            <tr>
                {{-- <td>
                    @if ( $image = $testimonial->getImage() )
                        <img src="{{$image}}" style="width: 50px;height:50px;" alt="">
                    @endif
                </td> --}}

                <td>
                    {{ $testimonial->title }}
                </td>
                <td>
                    {{ Str::of($testimonial->description)->words(20) }}
                </td>
                <td>
                    {{ $testimonial->name }}
                </td>
                {{-- <td>
                    {{ $testimonial->rating }}
                </td> --}}
                <td>
                    {{ $testimonial->created_at->format('m-d-Y g:i:s a') }}
                </td>
                <td>
                    <div class="btn-group">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success dropdown-toggle waves-effect waves-light">
                                Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropright">

                                <a href="{{ route('admin.testimonials.edit',$testimonial) }}" title="Edit Page" class="dropdown-item w-100">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                                <button class="dropdown-item w-100 text-danger position-relative" wire:click="$emit('confirmDelete','{{$testimonial->id}}')">
                                    <i class="feather icon-trash-2"></i> Delete
                                    @include('layouts.livewire.button-loading')
                                </button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No record found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-end px-2 mx-2 my-2">
        {{ $testimonials->links() }}
    </div>
    @include('layouts.livewire.loading')
</div>
