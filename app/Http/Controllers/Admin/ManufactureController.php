<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App\Http\Requests\Manufacture\CreateManufactureRequest;
use App\Http\Requests\Manufacture\UpdateManufactureRequest;
use App\Models\Manufacturer;
use App\Repositories\ManufactureRepository;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manufacture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacture.create');
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
            session()->flash('alert-success','Manufacturer Created Successfully.');
            return redirect()->route('admin.manufacturers.index');
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
    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacture.edit',compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufactureRequest $request, Manufacturer $manufacturer, ManufactureRepository $manufactureRepository)
    {
        try{
            $manufactureRepository->update($request, $manufacturer);
            session()->flash('alert-success','Manufacturer Updated Successfully.');
            return redirect()->route('admin.manufacturers.index');
        }catch(Exception $ex){
            session()->flash('alert-danger','Error: '.$ex->getMessage());
            return back()->withInput();
        }
    }

}
