<li class="item my-1 dd-item" data-id="{{ $item->id }}">
    <div class="shadow pr-1 rounded bg-light d-flex w-100 align-items-center">
        <div class="dd-handle px-1 cursor-move">
            <i class="fa fa-list"></i>
        </div>
        <div class="px-1 dd-content">
            <strong>
                {{ $item->title }}
            </strong>
            <br>
            <small>
                {{ $item->link }}
            </small>
        </div>
        <div class="dd-actions">
            <button class="btn btn-primary btn-sm" wire:click.prevent="$emit('edit-item','{{$item->id}}')">
                Edit
            </button>
            <button class="btn btn-danger btn-sm" wire:click.prevent="$emit('delete-item','{{$item->id}}')">
                Delete
            </button>
        </div>
    </div>

    @if ($item->children->isNotEmpty())
        <ol class="nested-group dd-list">
            @foreach ($item->children as $child)
                @include('menu::builder-item',[
                    'item' => $child
                ])
            @endforeach
        </ol>
    @endif
    </li>
