<?php

namespace Topdot\Core\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use ValidatesRequests;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('core::profile.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'full_name' => 'required',
        ];

        if ( $request->has('password') && $request->password){
            $rules['password'] = 'required|confirmed|min:8|max:16';
        }

        $this->validate($request,$rules);

        $user = Auth::user();

        if ( $request->hasFile('image') && $request->file('image') ){
            $user->clearMediaCollection('profile');
            $user->addMediaFromRequest('image')->toMediaCollection('profile');
        }

        $user->name = $request->full_name;

        if ( $request->has('password') && $request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        session()->flash('alert-success','Profile Updated');

        return back();
    }
}
