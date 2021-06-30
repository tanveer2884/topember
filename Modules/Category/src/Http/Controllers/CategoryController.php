<?php

namespace Topdot\Category\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Topdot\Category\Models\Category;
use Topdot\Category\Repositories\CategoryRepository;
use Topdot\Category\Http\Requests\CategoryCreateRequest;
use Topdot\Category\Http\Requests\CategoryUpdateRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->get(\request(),50,'DESC','created_at');
        return view('category::index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getExcept(-1);
        return view('category::create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $categoryCreateRequest
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $categoryCreateRequest, CategoryRepository $categoryRepository)
    {
        try {
            $categoryRepository->store($categoryCreateRequest);
            session()->flash('alert-success','Category Created Successfully');
            return redirect()->route(config('category.routeNamePrefix').'categories.index');
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category::show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getExcept($category->id);
        return view('category::edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category, CategoryRepository $categoryRepository)
    {
        try {
            $categoryRepository->update($category,$request);
            session()->flash('alert-success','Category Updated Successfully');
            return redirect()->route(config('category.routeNamePrefix').'categories.index');
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, CategoryRepository $categoryRepository)
    {
        try {
            $categoryRepository->delete($category);
            session()->flash('alert-success','Category Deleted Successfully');
            return redirect()->route(config('category.routeNamePrefix').'categories.index');
        }catch (Exception $categoryDeleteException){
            session()->flash('alert-danger',$categoryDeleteException->getMessage());
            return back();
        }
    }
}
