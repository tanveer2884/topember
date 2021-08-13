<?php

namespace Topdot\Cms\Http\Controllers;

use Illuminate\Support\Str;
use Topdot\Cms\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PageEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Page $page)
    {
        return $page->getEditor();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Page $page)
    {
        return $page->saveEditorData($request);
        
    }

    public function templates(Page $page)
    {
       return array_merge(
           $page->getTemplatesFromPath(config('cms.templatesPath')),
           $page->getBlocksFromPath(config('cms.blocksPath')),
        );
    }
}
