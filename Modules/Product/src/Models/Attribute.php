<?php

namespace Topdot\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [];
    
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getValueIds()
    {
        return $this->values()->select('id')->pluck('id')->toArray();
    }

    
}
