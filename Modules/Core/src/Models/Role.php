<?php


namespace Topdot\Core\Models;

use Topdot\Core\Traits\HasPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasPermission;

    const ROLE_SUPER_ADMIN = 'superAdmin';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function isDeleteable()
    {
        return $this->deleteable;
    }

    public function isSuperAdmin()
    {
        return $this->name == self::ROLE_SUPER_ADMIN;
    }
}
