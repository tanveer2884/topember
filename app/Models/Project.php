<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Traits\MediaConversions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use EditableTrait;
    use HasSlug;
    use HasFactory,
        InteractsWithMedia,
        MediaConversions {
        MediaConversions::registerMediaConversions insteadof InteractsWithMedia;
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(100)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function scopeSearch(Builder $builder, string $query): Builder
    {
        return $builder->where(function (Builder $builder) use ($query) {
            $query = "%{$query}%";

            $builder->where('title', 'like', $query);
            $builder->orWhere('slug', 'like', $query);
        });
    }
}
