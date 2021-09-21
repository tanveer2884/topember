<div class="root dd position-relative" wire:sortable="updateSorting" wire:sortable-group="updateSortingGroup">
    <ol class="dd-list">
        @foreach ($items as $item)
            @include('menu::builder-item')
        @endforeach
    </ol>
</div>

@push('css')
    <style>
        .root ol {
            list-style-type: none;
            list-style: none;
        }

        ol.draging,
        li.draging {
            list-style-type: none;
            list-style: none;
        }

        .drag-placeholder {
            width: 100%;
            height: 41px;
            background-color: white;
            border: 1px dashed gray;
            border-radius: 10px;
            margin-top: 5px;
        }
        .dd-handle {
            display: flex; align-items: center;
            background-color: #7367f0 !important;
            height: 36px;
            -webkit-border-top-left-radius: .5rem;
            -webkit-border-bottom-left-radius: .5rem;
            -moz-border-radius-topleft: .5rem;
            -moz-border-radius-bottomleft: .5rem;
            border-top-left-radius: .5rem;
            border-bottom-left-radius: .5rem;
        }
        .dd-handle i {
            color: #FFF;
        }
        .dd-content { flex: 1; }

    </style>
@endpush

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded',function(){
            initNestable();
        })

        function initNestable(){
            $('.dd').nestable({
                expandBtnHTML: null,
                collapseBtnHTML: '',
                dragClass: 'draging d-none',
                placeClass: 'drag-placeholder',
                callback: function(){
                    let data = $('.dd').nestable('serialize');
                    window.Livewire.emit('updateSorting',data);
                }
            });
        }

        function destroyNestable(){
            $('.dd').nestable('destroy');
        }

        function reInitNestable(){
            destroyNestable();
            initNestable();
        }
    </script>
@endpush
