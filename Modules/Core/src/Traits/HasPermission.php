<?php

namespace Topdot\Core\Traits;

use Topdot\Core\Models\Permission;

trait HasPermission{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function modules()
    {
        return $this->permissions->groupBy('group');
    }

    /**
     * @var int|array $permissions
     */
    public function assignPermissions($permissions)
    {
        return $this->permissions()->attach($permissions);
    }

    /**
     * @var int|array $permissions
     */
    public function removePermissions($permissions)
    {
        return $this->permissions()->detach($permissions);
    }

    /**
     * @param string $permission
     */
    public function hasPermission($permission)
    {
        return $this->permissions()->where('slug',$permission)->count();
    }
}
