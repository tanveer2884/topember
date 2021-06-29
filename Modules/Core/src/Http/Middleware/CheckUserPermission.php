<?php 

namespace Topdot\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Topdot\Core\Models\Role;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if ( !Auth::check() ){
            abort(401,'Unauthorized');
        }

        if ( 
            Auth::user()->hasRole([Role::ROLE_SUPER_ADMIN]) ||
            Auth::user()->hasPermissionTo( $request->route()->getName() )
            ){
            return $next($request);
        }

        return abort(403);
    }
}