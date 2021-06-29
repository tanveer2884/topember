<?php

namespace Topdot\Core\Http\Controllers;

use Exception;
use function back;
use function view;
use function session;
use Illuminate\Routing\Controller;
use Topdot\Core\Repositories\SettingRepository;
use Topdot\Core\Http\Requests\SettingUpdateRequest;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('core::settings.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param SettingUpdateRequest $request
     * @param SettingRepository $repository
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(SettingUpdateRequest $request,SettingRepository $repository)
    {
        try {
            $repository->update($request);
            session()->flash('alert-success','Settings Saved');
            return back();
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back();
        }
    }
}
