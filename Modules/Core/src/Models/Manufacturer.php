<?php

namespace Topdot\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Manufacturer extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name'
    ];

    public function getImage($default=null)
    {
        return $this->hasMedia('image') ? route('api.medias.show',$this->getFirstMedia('image')) : $default;
    }

}
