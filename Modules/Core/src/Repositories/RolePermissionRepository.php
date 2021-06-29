<?php


namespace Topdot\Core\Repositories;


use Illuminate\Http\Request;
use Topdot\Core\Models\Role;
use Topdot\Core\Models\Permission;

class RolePermissionRepository
{
    public function getModules()
    {
        return Permission::query()
            ->orderBy('group','ASC')
            ->get()
            ->groupBy('group');
    }

    /**
     * @param Role $role
     * @param Request $request
     * @return array
     */
    public function store(Role $role, Request $request): array
    {
        return $role->permissions()->sync($request->get('permissions',[]));
    }
}
