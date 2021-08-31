<?php

namespace Topdot\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Topdot\Core\Http\Requests\Manufacture\CreateManufactureRequest;
use Topdot\Core\Http\Requests\Manufacture\UpdateManufactureRequest;
use Topdot\Core\Models\Manufacturer;
use Topdot\Core\Repositories\ManufactureRepository;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('core::manufacture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('core::manufacture.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateManufactureRequest $request, ManufactureRepository $manufactureRepository)
    {
        try{

            $manufactureRepository->store($request);
            session()->flash('alert-success','Manufacture Created Successfully.');
            return redirect()->route('admin.manufactures.index');
        }catch(Exception $ex){
            session()->flash('alert-danger','Error: '.$ex->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Manufacturer $manufactures
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacture)
    {
        return view('core::manufacture.edit',compact('manufacture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufactureRequest $request, Manufacturer $manufacture, ManufactureRepository $manufactureRepository)
    {
        try{
            $manufactureRepository->update($request, $manufacture);
            session()->flash('alert-success','Manufacture Updated Successfully.');
            return redirect()->route('admin.manufactures.index');
        }catch(Exception $ex){
            session()->flash('alert-danger','Error: '.$ex->getMessage());
            return back()->withInput();
        }
    }

}
