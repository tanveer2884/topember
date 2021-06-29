<?php 

namespace Topdot\Core\Traits;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

trait TimeZoneAware{

    /**
     * Override create() to save user supplied dates as app timezone
     * 
     * @param array      $attributes
     * @param bool|mixed $allow_empty_translations
     */
    public static function create(array $attributes = [], $allow_empty_translations=false)
    {
        if ( !Auth::check() ){
            return static::query()->create($attributes);
        }
        // get empty model so we can access properties (like table name and fillable fields) that really should be static!
        // https://github.com/laravel/framework/issues/1436
        $emptyModel = new static;

        // ensure dates are stored with the app's timezone
        foreach ($attributes as $attribute_name => $attribute_value) {
            // do we have date value, that isn't Carbon instance? (assumption with Carbon is timezone value will be correct)
            if (!empty($attribute_value) && !$attribute_value instanceof Carbon && in_array($attribute_name, $emptyModel->dates)) {
                // update attribute to Carbon instance, created with current timezone and converted to app timezone
                $attributes[$attribute_name] = Carbon::parse($attribute_value, self::getLocale()->timezone)->setTimezone(config('app.timezone'));
            }
        }

        // https://github.com/laravel/framework/issues/17876#issuecomment-279026028
        $model = static::query()->create($attributes);

        return $model;
    }

    /**
     * Override update(), to save user supplied dates as app timezone
     *
     * @param array $attributes
     * @param array $options
     */
    public function update(array $attributes = [], array $options = [])
    {
        if ( !Auth::check() ){
            return parent::update($attributes, $options);
        }

        // ensure dates are stored with the app's timezone
        foreach ($attributes as $attribute_name => $attribute_value) {
            // do we have date value, that isn't Carbon instance? (assumption with Carbon is timezone value will be correct)
            if (!empty($attribute_value) && !$attribute_value instanceof Carbon && in_array($attribute_name, $this->dates)) {
                // update attribute to Carbon instance, created with current timezone and converted to app timezone
                $attributes[$attribute_name] = Carbon::parse($attribute_value, auth()->user()->timezone())->setTimezone('UTC');
            }
        }

        // update model
        return parent::update($attributes, $options);
    }

    /**
     * Override getAttribute() to get times in local time
     *
     * @param mixed $key
     */
    public function getAttribute($key)
    {
        $attribute = parent::getAttribute($key);

        if ( !Auth::check() ){
            return $attribute;
        }

        // we apply current timezone to any timestamp / datetime columns (these are Carbon objects)
        if ($attribute instanceof Carbon) {
            $attribute->tz(auth()->user()->timezone());
        }

        return $attribute;
    }
}