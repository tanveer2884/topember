<?php

namespace Topdot\Core\Contracts\Repositories;

use Illuminate\Http\Request;

class BaseRepository
{
    public function get(Request $request, $paginate = 50, $sortOrder = 'Asc', $orderBy = 'id')
    {
        
    }
}