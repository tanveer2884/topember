<?php

namespace Topdot\Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Topdot\Core\Services\Excel\Export\User\UserCsvSampleFileExportService;
use Topdot\Core\Services\Excel\Export\User\UserErroredCsvExportService;
use Topdot\Core\Services\Excel\Import\UserImportService;

class UserImportController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        return view('core::user.import');
    }

    public function store(Request $request)
    {
       $this->validate($request,[
           'import_file'
       ]);

       try{
           $importService = new UserImportService($request->file('import_file'));
           
           $errors = $importService->handle();

           if ( $errors->isNotEmpty() ){
               session()->put('last_errored_users',$errors);
               session()->flash('alert-success','File imported Successfully. But some records contains errors. please click button to download records with issues');
               return redirect()->back()->with('showErrorDownloadButton','showErrorDownloadButton');
           }
           
           session()->flash('alert-success','File imported Successfully');
           return redirect()->route( config('core.routeNamePrefix').'users.index' );
       }catch(Exception $ex){
           session()->flash('alert-danger',$ex->getMessage());
           return back();
       }
    }

    public function download()
    {
        $tempFileService = new UserCsvSampleFileExportService();
        return $tempFileService->handle();
    }

    public function downloadErrors()
    {

        if ( ! session('last_errored_users') && ! session('last_errored_users') instanceof Collection){
            session()->flash('alert-warning','No Error File found');
            return redirect()->route( config('core.routeNamePrefix').'users.index' );
        }

        $users = session('last_errored_users');
        session()->forget('last_errored_users');
        $errorDownlodService = new UserErroredCsvExportService( $users );
        return $errorDownlodService->handle();
    }
}
