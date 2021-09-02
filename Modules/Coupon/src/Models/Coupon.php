<?php

namespace Topdot\Coupon\Models;

use Carbon\Carbon;
use App\Models\User;
use Topdot\Product\Models\Product;
use Topdot\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime'
    ];

    protected $appends = [
        'discount_is_percent'
    ];

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active',true);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function includedCategories(): BelongsToMany
    {
        return $this->categories()->wherePivot('exclude',false);
    }

    public function excludedCategories(): BelongsToMany
    {
        return $this->categories()->wherePivot('exclude',true);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function includedProducts(): BelongsToMany
    {
        return $this->products()->wherePivot('exclude',false);
    }

    public function excludedProducts(): BelongsToMany
    {
        return $this->products()->wherePivot('exclude',true);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function isDiscountPercent()
    {
        return $this->discount_type == 'percent';
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function isSiteWide()
    {
        return $this->is_site_wide;
    }

    public function isShippingFree()
    {
        return $this->is_free_shipping;
    }

    public function markActive(bool $active=true)
    {
        return $this->update([
            'is_active' => $active
        ]);
    }

    public function getStartAtAttribute($date)
    {
        if ( !$date){
            return "";
        }
        return $this->castAttribute('start_at',$date);
    }

    public function getEndAtAttribute($date)
    {
        if ( !$date){
            return "";
        }
        return $this->castAttribute('end_at',$date);
    }

    public function getStartAtFormattedAttribute()
    {
        if ( $this->start_at != "" ){
            return $this->start_at->format('Y-m-d');
        }

        return $this->start_at;
    }

    public function getEndAtFormattedAttribute()
    {
        if ( $this->end_at != "" ){
            return $this->end_at->format('Y-m-d');
        }

        return $this->end_at;
    }

    public function isExpiredOrNotAvailable()
    {
        if ( $this->start_at instanceof Carbon && $this->start_at->startOfDay()->gte(Carbon::now()) ){
            return true;
        }

        if ( $this->end_at instanceof Carbon && $this->end_at->endOfDay()->lte(Carbon::now())){
            return true;
        }

        return false;

    }

    public function getDiscountIsPercentAttribute()
    {
        return $this->isDiscountPercent();
    }
}
