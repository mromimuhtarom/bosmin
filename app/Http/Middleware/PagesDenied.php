<?php

namespace App\Http\Middleware;

use Closure;
use App\helpers\RolesClass;
use App\helpers\MenuClass;

class PagesDenied
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menus1 = RolesClass::RoleType0($menuname);
        $status = MenuClass::DBMenuStatus($menuname);

        if($menus1 || $status)
        {
            return new Response(view('pages_denied'));
            // abort(403, 'Mohon maaf halaman ini sedang di blok');
        }
        return $next($request);
    }
}
