<div class="position-relative d-flex justify-content-center align-items-center p-2">
    @Foreach($model->getMedia($collection) as $media )
        <div class="image-wrapper position-relative p-1">
            <button type="button" style="width: 25px;height:25px;right:0;top:0;" wire:click="remove('{{$media->id}}')" class="p-0 btn btn-danger rounded-circle position-absolute">
                X
            </button>
            <img src="{{ route('api.medias.show',$media) }}" style="width: 100px;height:100px;" alt="" class="d-inline-block">
        </div>
    @endforeach

    <div wire:loading class="position-absolute w-100 h-100" style="top:0;left:0; background-color:#fff;opacity:0.5;">
        <div class="d-flex align-items-center justify-content-center w-100 h-100">
            <h4>
                <i class="fa fa-spinner fa-spin"></i>
            </h4>
        </div>
    </div>
</div>
