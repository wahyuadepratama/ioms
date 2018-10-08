<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAnggotaPengurus
{
  public function handle($request, Closure $next)
  {
    if(Auth::user()->id_role == 3 | Auth::user()->id_role == 2) {
        return $next($request);
    }else {
        return abort(404);
    }
  }
}
