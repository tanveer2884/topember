<?php

namespace Topdot\Core\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const SITE_SETTING_ID = -1;

    protected $guarded = [];

    public function scopeByKey(Builder $query, $key): Builder
    {
        return $query->where('key',strtoupper($key));
    }

    public function scopeByUser(Builder $query, $userId ): Builder
    {
        return $query->where('user_id',$userId);
    }

    public static function saveByKey($key,$value,$userId)
    {
        try {
            $setting =  setting($key,null,$userId,true);

            if ( $setting && $setting->id){
                return $setting->update([
                    'value' => $value
                ]);
            }

            return Setting::create([
                'key' => strtoupper($key),
                'value' => $value,
                'user_id' => $userId
            ]);
        }catch (\Exception $exception) {
            throw new Exception("Error While Saving: {$key} => {$value} : ". $exception->getMessage());
        }
    }
}
