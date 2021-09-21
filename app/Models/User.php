<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Topdot\Core\Models\User as ModelsUser;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Topdot\Order\Models\Order;

class User extends ModelsUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
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
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function sendPasswordResetNotification($token)
    {
        if ( $this->isCustomer() ){
            ResetPasswordNotification::createUrlUsing(function() use($token){
                return route('user.reset-password',['token'=>$token,'email'=>$this->email]);
            });
            $this->notify(new ResetPasswordNotification($token));
            return;
        }

        $this->notify(new ResetPasswordNotification($token));
    }
}
