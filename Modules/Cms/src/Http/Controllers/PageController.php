<?php

namespace Topdot\Cms\Http\Controllers;

use Exception;
use Topdot\Cms\Models\Page;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Topdot\Cms\Repositories\PageRepository;
use Topdot\Cms\Http\Requests\PageCreateRequest;
use Topdot\Cms\Http\Requests\PageUpdateRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('cms::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageCreateRequest $request
     * @param PageRepository $pageRepository
     * @return Response
     */
    public function store(PageCreateRequest $request, PageRepository $pageRepository)
    {
        try {
            $pageRepository->store($request);
            session()->flash('alert-success','Page Created Successfully');
            return redirect()->route(config('cms.routeNamePrefix').'pages.index');
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return Response
     */
    public function edit(Page $page)
    {
        return view('cms::edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageUpdateRequest $request
     * @param Page $page
     * @param PageRepository $pageRepository
     * @return Response
     * @throws PageCreateException
     */
    public function update(PageUpdateRequest $request, Page $page, PageRepository $pageRepository)
    {
        try {
            $pageRepository->update($request,$page);
            session()->flash('alert-success','Page Updated Successfully');
            return redirect()->route(config('cms.routeNamePrefix').'pages.index');
        }catch (Exception $exception){
            session()->flash('alert-danger',$exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        session()->flash('alert-success','Page Deleted Successfully');
        return back();
    }
}
