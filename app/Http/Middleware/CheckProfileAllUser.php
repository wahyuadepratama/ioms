<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfileAllUser
{

  public function handle($request, Closure $next)
  {
    if(null !== ($request->route('username_edit'))){

      $url = $request->route('username_edit');

      if($url == Auth::user()->username) {
          return $next($request);
      }else {
          return abort(404);
      }

    }elseif (null !== ($request->route('username'))) {

      return $next($request);

    }
  }
}
