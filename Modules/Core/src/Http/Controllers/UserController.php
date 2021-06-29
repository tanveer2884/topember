<?php

namespace Topdot\Core\Http\Controllers;

use Exception;
use Topdot\Core\Models\User;
use Illuminate\Routing\Controller;
use Topdot\Core\Repositories\UserRepository;
use Topdot\Core\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('core::user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('core::user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('core::user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @param UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user, UserRepository $userRepository)
    {
        try {
            $userRepository->update($user,$request);
            session()->flash('alert-success','User Updated Successfully');
            return redirect()->route( config('core.routeNamePrefix').'users.index');
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('alert-success','User Deleted');
        return back();
    }
}
