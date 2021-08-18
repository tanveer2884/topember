<?php

namespace Topdot\Category\Models;

use Database\Factories\CategoryFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Topdot\Product\Models\Product;
use Topdot\Core\Traits\WithUniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, WithUniqueId, HasSlug, InteractsWithMedia;

    protected $guarded = [];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active',true);
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_category_id');
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class,'parent_category_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getImage($default=null)
    {
        return $this->hasMedia('default') ? route( 'api.medias.show',$this->getFirstMedia('default')) : $default;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->is_active;
    }

    public function markActive($active=true): Category
    {
        $this->update([
            'is_active' => $active
        ]);

        return $this;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new CategoryFactory();
    }
}
