<?php

namespace Topdot\Order\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Topdot\Product\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS_NEW = 'new';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function setCartAttribute($value)
    {
        $this->attributes['cart'] = serialize($value);
    }

    public function getCartAttribute($value)
    {
        return unserialize($value);
    }

    public function isNew()
    {
        return $this->status == self::STATUS_NEW;
    }

    public function isProcessing()
    {
        return $this->status == self::STATUS_PROCESSING;
    }

    public function isCompleted()
    {
        return $this->status == self::STATUS_COMPLETED;
    }

    public function isShippingBillingSame()
    {
        return  $this->is_billing_same_as_shipping;
    }

    public static function getOrderId()
    {
        return substr(microtime(true)*1000,2,8);
    }
}
