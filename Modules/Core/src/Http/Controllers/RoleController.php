<?php

namespace Topdot\Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Topdot\Core\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Topdot\Core\Repositories\RolesRepository;
use Topdot\Core\Http\Requests\RoleCreateRequest;
use Topdot\Core\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param RolesRepository $rolesRepository
     * @return Response
     */
    public function index(Request $request,RolesRepository $rolesRepository)
    {
        $roles = $rolesRepository->get($request);
        return view('core::role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('core::role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleCreateRequest $request
     * @param RolesRepository $rolesRepository
     * @return Response
     */
    public function store(RoleCreateRequest $request, RolesRepository $rolesRepository)
    {
        try {
            $rolesRepository->store($request);
            session()->flash('alert-success','Role Created Successfully');
            return redirect()->route(config('core.routeNamePrefix').'roles.index');
        }catch (Exception $exception){
            session()->flash('alert-danger', $exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\User\Models\Role  $role
     * @return Response
     */
    public function show(Role $role)
    {
        return view('core::role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        if ($role->isSuperAdmin()) {
            abort(403,'Cannot Update Super Admin role');
        }

        return view('core::role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleUpdateRequest $request
     * @param Role $role
     * @param RolesRepository $rolesRepository
     * @return Response
     */
    public function update(RoleUpdateRequest $request, Role $role, RolesRepository $rolesRepository)
    {
        if ($role->isSuperAdmin()) {
            abort(403,'Cannot Update Super Admin role');
        }

        try {
            $rolesRepository->update($role,$request);
            session()->flash('alert-success','Role Updated Successfully');
            return redirect()->route(config('core.routeNamePrefix').'roles.index');
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Modules\User\Models\Role $role
     * @param RolesRepository $rolesRepository
     * @return Response
     */
    public function destroy(Role $role, RolesRepository $rolesRepository)
    {
        if ($role->isSuperAdmin()) {
            abort(403,'Cannot Delete Super Admin role');
        }
        try {
            $rolesRepository->delete($role);
            session()->flash('alert-success','Role Delete Successfully');
            return redirect()->route(config('core.routeNamePrefix').'roles.index');
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back();
        }
    }
}
