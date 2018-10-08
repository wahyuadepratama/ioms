<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminPengurus
{
  public function handle($request, Closure $next)
  {
    if(Auth::user()->id_role == 1 | Auth::user()->id_role == 2) {
        return $next($request);
    }else {
        return abort(404);
    }
  }
}
