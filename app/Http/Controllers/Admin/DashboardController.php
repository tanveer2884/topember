<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ReportsRepository;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
