<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Faq extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    const TYPE_HOMEPAGE = 'homepage';

    protected $guarded = [];
    
}
