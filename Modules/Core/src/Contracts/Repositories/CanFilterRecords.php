<?php
namespace Topdot\Core\Contracts\Repositories;

use Illuminate\Http\Request;

interface CanFilterRecords
{
    public function get(Request $request,$paginate=50,$sortOrder='Asc',$orderBy='id');
}
