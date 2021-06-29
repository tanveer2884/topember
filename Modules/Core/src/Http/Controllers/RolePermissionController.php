<?php

namespace Topdot\Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Topdot\Core\Models\Role;
use Illuminate\Routing\Controller;
use Topdot\Core\Repositories\RolePermissionRepository;
use Topdot\Core\Http\Requests\RolePermissionUpdateRequest;

class RolePermissionController extends Controller
{

    /**
     * @param Role $role
     * @param Request $request
     * @param RolePermissionRepository $rolesRepository
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role,Request $request, RolePermissionRepository $rolesRepository)
    {
        $modules = $rolesRepository->getModules();
        return view('core::role.permissions.index',compact('role','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Role $role
     * @param RolePermissionUpdateRequest $request
     * @param RolePermissionRepository $rolePermissionRepository
     * @return \Illuminate\Http\Response
     * @throws \Modules\Role\Exceptions\RolePermissionUpdateException
     */
    public function store(Role $role, RolePermissionUpdateRequest $request, RolePermissionRepository $rolePermissionRepository)
    {
        try {
            $rolePermissionRepository->store($role,$request);
            session()->flash('alert-success','Role Permission Updated Successfully');
            return redirect()->route(config('core.routeNamePrefix').'roles.index');
        }catch (Exception $exception){
            session()->flash('alert-danger', $exception->getMessage());
            return back()->withInput();
        }
    }
}
