<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonials\CreateTestimonial;
use App\Http\Requests\Testimonials\UpdateTestimonial;
use App\Repositories\HappyCustomerRepository;
use App\Repositories\TestimonialRepository;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.testimonials.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTestimonial $request, TestimonialRepository $testimonialRepository)
    {
        try{
            $testimonialRepository->store($request);
            session()->flash('alert-success','Testimonial Created Successfully');
            return redirect()->route('admin.testimonials.index');
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
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonial $request, Testimonial $testimonial, TestimonialRepository $testimonialRepository)
    {
        try{
            $testimonialRepository->update($request, $testimonial);
            session()->flash('alert-success','Testimonial Updated Successfully');
            return redirect()->route('admin.testimonials.index');
        }catch(Exception $ex){
            session()->flash('alert-danger','Error: '.$ex->getMessage());
            return back()->withInput();
        }
    }
}
