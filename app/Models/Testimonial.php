<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded= [];

    public function getImage($collection='image')
    {
        return $this->hasMedia($collection) ? route('api.medias.show',$this->getFirstMedia($collection)) : null;
    }
}
