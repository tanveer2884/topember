<?php

namespace Topdot\Menu\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeByName(Builder $builder,$name)
    {
        return $builder->where('name',$name);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class,'menu_id')->orderBy('order','ASC');
    }

    public static function getMenuByName($name)
    {
        return MenuItem::whereHas('menu',function($query) use($name){
            return $query->where('name',$name);
        })
        ->with('children')
        ->doesntHave('parent')
        ->orderBy('order')
        ->get();
    }

    protected static function boot()
    {
        parent::boot();
        self::deleting(function(Menu $menu){
            if ( $menu->items->isEmpty() ){
                return;
            }

            foreach ($menu->items as $menuItem) {
                $menuItem->delete();
            }
        });
    }
}
