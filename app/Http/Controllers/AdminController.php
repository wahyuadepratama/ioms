<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function getAllUser(){
      $users = User::join('roles','roles.id','=','users.role_id')
              ->select('roles.*','users.*')
              ->get();
      $deletedUsers = User::onlyTrashed()->get();

      return view('admin/user-management', ['users' => $users, 'deletedUsers'=>$deletedUsers]);
    }

    public function deleteUser($id){
      $user = User::find($id);
      $user->delete();
      return back()->with('success','You have successfully delete user');
    }

    public function restoreUser($id){
      $restore = User::withTrashed()->where('id',$id);
      $restore->restore();
      return back()->with('success','You have successfully restore user');
    }

}
