@switch($modalType)
    @case('pre-alert-detail')
        <x-modals.pre-alert-detail :id="$modalDataId"></x-modals.pre-alert-detail>
        @break
    @default
        Invalid Modal Type
@endswitch