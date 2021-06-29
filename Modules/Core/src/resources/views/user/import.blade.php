@extends('layouts.master')
@section('page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Import Users</h4>
                        <a href="{{ route(config('core.routeNamePrefix').'users.index') }}" class="btn btn-primary">Back to List</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if ( session('showErrorDownloadButton') )
                            <div class="controls row mb-1 justify-content-center">
                                <div class="col-md-6">
                                    <div class="alert alert-danger d-block">
                                        Click <a href="{{ route(config('core.routeNamePrefix').'errors-file') }}" class="btn btn-sm my-2 btn-danger">Download</a> to download Records with errors.
                                    </div>
                                </div>
                            </div>
                            @endif
                            <form action="{{ route(config('core.routeNamePrefix').'import-users.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="controls row mb-1 align-items-center">
                                    <label class="col-md-3 text-md-right">Select File</label>
                                    <div class="col-md-6">
                                        <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  class="form-control" name="import_file" required />
                                        @error('import_file')
                                        <div class="help-block text-danger"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="controls row mb-1 justify-content-center">
                                    <div class="alert alert-success col-md-6 p-2">
                                        Follow instruction to import Users from Excel or CSV.
                                        <ol class="mt-1">
                                            <li class="mb-1">User only sample file to fill in data and import</li>
                                            <li class="mb-1">File must not be greater then 8mb in size</li>
                                            <li class="mb-1">Download File <a href="{{ route(config('core.routeNamePrefix'). 'samplefile') }}" class="btn btn-primary btn-sm">Download</a></li>
                                        </ol>
                                    </div>
                                </div>


                                <div class="row mt-1 justify-content-center">
                                    <div class="col-6 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
