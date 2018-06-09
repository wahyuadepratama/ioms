<?php

namespace App\Http\Controllers;

use App\Anggota;
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

    public function getAllUser(){
      $users = Anggota::join('roles','roles.id','=','anggota.id_role')
              ->select('roles.*','anggota.*')
              ->get();
      $deletedUsers = Anggota::onlyTrashed()->get();

      return view('admin/user-management', ['users' => $users, 'deletedUsers'=>$deletedUsers]);
    }

    public function deleteUser($id){
      $user = Anggota::find($id);
      $user->delete();
      return back()->with('success','You have successfully delete user');
    }

    public function restoreUser($id){
      $restore = Anggota::withTrashed()->where('id',$id);
      $restore->restore();
      return back()->with('success','You have successfully restore user');
    }

}
