<?php

namespace Topdot\Product\Models;

use Carbon\Carbon;
use Jorenvh\Share\Share;
use App\Models\Manufacturer;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Topdot\Category\Models\Category;
use Topdot\Product\Models\Attribute;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelJsonColumn\Traits\JsonColumn;
use Illuminate\Database\Eloquent\Builder;
use Topdot\Product\Models\AttributeValue;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Topdot\Product\Contracts\Product as ContractsProduct;

class Product extends Model implements HasMedia, ContractsProduct
{
    use HasFactory, InteractsWithMedia, HasSlug, JsonColumn;

    protected $guarded = [];

    protected $casts = [
        'special_end_at' => 'datetime',
        'special_start_at' => 'datetime',
        'extra_data' => 'array'
    ];

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active',true);
    }

    public function scopeFeatured(Builder $builder)
    {
        return $builder->where('is_featured',true);
    }

    public function scopeInStock(Builder $builder)
    {
        return $builder->where('is_inStock',true);
    }

    public function scopeIsAvailable(Builder $builder)
    {
        return $builder->where('products.qty','>',0);
    }

    public function scopeHomepage(Builder $builder)
    {
        return $builder->where('is_show_on_homepage',true);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function attributeValueIds($attribute=null)
    {
        if ( $attribute ){
            return $this->attributeValues()->select('id')->wherePivot('attribute_id',$attribute)->pluck('id')->toArray();
        }

        return $this->attributeValues()->select('id')->pluck('id')->toArray();
    }

    public function attributeValueNames($attribute=null)
    {
        if ( $attribute ){
            return $this->attributeValues()->select('name')->wherePivot('attribute_id',$attribute)->pluck('name')->toArray();
        }

        return $this->attributeValues()->select('name')->pluck('name')->toArray();
    }

    public function getFeatureImageAttribute()
    {
        return $this->hasMedia('feature') ? route('api.medias.show',$this->getFirstMedia('feature')) : null;
    }

    public function getImage($collection='additional_images', $default=null)
    {
        return $this->hasMedia($collection) ? route('api.medias.show',$this->getFirstMedia($collection)) : null;
    }

    public function getImages($collection = 'additional_images', $default = [])
    {
        return $this->hasMedia($collection) ? $this->getMedia($collection) : $default;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function isInStock()
    {
        return $this->is_inStock;
    }

    public function getSpecialStartAtAttribute($date)
    {
        if ( !$date){
            return "";
        }

        return $this->castAttribute('special_start_at',$date);
    }

    public function getSpecialEndAtAttribute($date)
    {
        if ( !$date){
            return "";
        }
        return $this->castAttribute('special_end_at',$date);
    }

    public function getSpecialStartAtFormattedAttribute()
    {
        if ( $this->special_start_at !="" ){
            return $this->special_start_at->format('Y-m-d');
        }

        return $this->special_start_at;
    }

    public function getSpecialEndAtFormattedAttribute()
    {
        if ( $this->special_end_at !="" ){
            return $this->special_end_at->format('Y-m-d');
        }

        return $this->special_end_at;
    }

    public function hasSpecialPrice()
    {
        if (!$this->special_price){
            return false;
        }

        if ( $this->special_start_at instanceof Carbon && $this->special_start_at->startOfDay()->gte(Carbon::now()) ){
            return false;
        }

        if ( $this->special_end_at instanceof Carbon && $this->special_end_at->endOfDay()->lt(Carbon::now()) ){
            return false;
        }

        return true;
    }

    public function getSpecialPrice()
    {
        return $this->hasSpecialPrice() ? $this->special_price : $this->price;
    }

    public function hasCategory($category)
    {
        $catId = $category instanceof Category ? $category->id : $category;

        return $this->categories()->where('id',$catId)->first();
    }

    public function categoryIds()
    {
        return $this->categories()->select('id')->get()->pluck('id')->toArray();
    }

    public function getPrice()
    {
        return $this->hasSpecialPrice() ? $this->getSpecialPrice() : $this->price;
    }


    public function getRelatedProducts()
    {
        return Product::whereHas('categories',function($query){
            return $query->whereIn('id',$this->categoryIds());
        })
        ->where('id','<>',$this->id)
        ->active()
        // ->featured()
        ->limit(30)
        ->get();
    }

    public function share($channel)
    {
        if ( !method_exists(Share::class,$channel) ){
            return '';
        }

        return (new Share)->page( route('product.index',$this->slug), $this->name )->$channel()->getRawLinks();
    }

    protected static function newFactory()
    {
        return new ProductFactory();
    }
}
