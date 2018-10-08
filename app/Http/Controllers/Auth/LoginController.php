<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Customize login disini.......

    public function username()
    {
       $login = request()->input('identity');
       $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
       request()->merge([$field => $login]);
       return $field;
    }
    // 
    // protected function validateLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         $this->username() => 'required|string|min:6',
    //         'password' => 'required|string',
    //     ]);
    // }

}
