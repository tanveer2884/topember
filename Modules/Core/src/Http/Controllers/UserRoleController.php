<?php

namespace Topdot\Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Topdot\Core\Models\User;
use Illuminate\Routing\Controller;
use Topdot\Core\Repositories\RolesRepository;
use Topdot\Core\Repositories\UserRoleRepository;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param User $user
     * @param RolesRepository $rolesRepository
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,User $user, RolesRepository $rolesRepository)
    {
        $roles = $rolesRepository->get($request,false);
        return view('core::user.roles.index',compact('user','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param User $user
     * @param \Illuminate\Http\Request $request
     * @param UserRoleRepository $userRoleRepository
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request, UserRoleRepository $userRoleRepository)
    {
        try {
            $userRoleRepository->store($user,$request);
            session()->flash('alert-success','Roles Updated');
            return redirect()->route(config('core.routeNamePrefix').'users.index');
        }catch (Exception $exception){
            session()->flash('alert-success',$exception->getMessage());
            return back();
        }
    }

}
