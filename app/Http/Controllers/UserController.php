<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
      $this->middleware('profile');
  }

  public function index($username){

    $user = User::where('username',$username)->where('role_id',3)
          ->orwhere('username',$username)->where('role_id',2)
          ->exists();

    if($user){
      dd('selamat datang di halaman profile '.$username);

    }else{
      $user = User::where('username',$username)->where('role_id',1)->exists();

      if(Auth::user()->role_id == 1 && $user = true){
        dd('selamat datang superadmin, nama akun: '.$username);
      }else{
        abort(404);
      }
    }

  }

  public function edit($username_edit){
    dd('halaman edit profile');
  }
}
