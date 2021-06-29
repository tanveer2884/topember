<?php


namespace Topdot\Core\Repositories;


use Illuminate\Http\Request;
use Topdot\Core\Models\User;

class UserRoleRepository
{
    public function store(User $user, Request $request)
    {
        return $user->roles()->sync($request->get('roles',[]));
    }
}
