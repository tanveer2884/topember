<?php

namespace Topdot\Core\Models;

use Topdot\Core\Traits\HasRole;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Topdot\Core\Traits\WithUniqueId;
use Illuminate\Notifications\Notifiable;
use LaravelJsonColumn\Traits\JsonColumn;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Topdot\Core\Contracts\HasStatus;

class User extends Authenticatable implements HasMedia, HasStatus
{
    use HasFactory, Notifiable, HasRole, WithUniqueId, InteractsWithMedia, JsonColumn;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'username',
        'address',
        'address2',
        'city',
        'zipCode',
        'state',
        'password',
        'is_active',
        'image_id',
        'locale',
        'timezone',
        'extra_data'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'extra_data' => 'array'
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active',true);
    }

    public function getTimezone()
    {
        return $this->timezone;
    }

    public  function  getLocale()
    {
        return $this->locale;
    }

    public function getImage()
    {
        if ( Auth::user()->getFirstMedia('profile') ){
            return route('api.medias.show',Auth::user()->getFirstMedia('profile'));
        }

        return asset('images/admin/logo.jpeg');
    }

    public function isAdmin()
    {
        return $this->hasRole([Role::ROLE_SUPER_ADMIN]);
    }

    public function isUser()
    {
        return !$this->isAdmin();
    }

    public function isCustomer()
    {
        return $this->roles()->count() <=0;
    }

    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    public function markActive($active=true)
    {
        $this->update([
            'is_active' => $active
        ]);

        return $this;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(),[
            'created_at' => $this->created_at->format('m-d-Y g:i:s a'),
            'updated_at' => $this->created_at->format('m-d-Y g:i:s a'),
        ]);
    }

}
