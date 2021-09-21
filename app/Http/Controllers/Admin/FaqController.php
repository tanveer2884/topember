<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\CreateFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFaqRequest $request, FaqRepository $faqRepository)
    {
        try{
            $faqRepository->store($request);
            session()->flash('alert-success','Faq Created Successfully');
            return redirect()->route('admin.faqs.index');
        }catch(Exception $ex){
            session()->flash('alert-danger','Error: '.$ex->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqRequest $request, Faq $faq, FaqRepository $faqRepository)
    {
        try{
            $faqRepository->update($request, $faq);
            session()->flash('alert-success','Faq Updated Successfully');
            return redirect()->route('admin.faqs.index');
        }catch(Exception $ex){
            session()->flash('alert-danger','Error: '.$ex->getMessage());
            return back()->withInput();
        }
    }


}
