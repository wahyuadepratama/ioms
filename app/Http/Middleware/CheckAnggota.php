<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAnggota
{
  public function handle($request, Closure $next)
  {
    if(Auth::user()->id_role == 3) {
        return $next($request);
    }else {
        return abort(404);
    }
  }
}
