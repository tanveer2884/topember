<?php

namespace Topdot\Menu\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active',true);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class,'parent_id')->orderBy('order','ASC');
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function(MenuItem $menuItem){
            if ( $menuItem->children->isEmpty() ){
                return;
            }

            foreach ($menuItem->children as $subMenu) {
                $subMenu->delete();
            }
        });
    }
}
