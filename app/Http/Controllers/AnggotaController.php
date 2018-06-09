<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
      $this->middleware('profile');
  }

  public function index()
  {
      return view('admin/dashboard');
  }

  public function profile(){
    $anggota = Anggota::join('roles','roles.id','=','anggota.id_role')
              ->select('roles.*','anggota.*')
              ->where('anggota.id','=', Auth::user()->id)
              ->get();
    return view('admin.profile',['anggota'=>$anggota]);
  }

  public function edit(){
    $anggota = Anggota::join('roles','roles.id','=','anggota.id_role')
              ->select('roles.*','anggota.*')
              ->where('anggota.id','=', Auth::user()->id)
              ->get();
    return view('admin.profile-edit',['anggota'=>$anggota]);
  }

  public function validator(array $data){

      return Validator::make($data, [
          'nama' => 'required|string|max:191',
          'nim' => 'required|string|max:10',
          'no_anggota' => 'max:10',
          'email' => 'required|string|email|max:191',
      ]);

  }

  public function store(Request $request){

    $this->validator($request->all())->validate();

    Anggota::where('id', Auth::user()->id)
            ->update([
                      'nama' => $request->nama,
                      'nim' => $request->nim,
                      'no_anggota' => $request->no_anggota,
                      'email' => $request->email,
                      'no_handphone' => $request->no_handphone,
                      'alamat' => $request->alamat,
                      'kutipan' => $request->kutipan,
                    ]);
    return redirect('profile')->with('success','You have successfully update your profile');
  }

  public function validatorPassword(array $data){

    return Validator::make($data, [
        'password' => 'max:191|confirmed|min:6',
    ]);
  }

  public function storePassword(Request $request){

    $this->validatorPassword($request->all())->validate();

    Anggota::where('id', Auth::user()->id)
            ->update(['password' => bcrypt($request->password), ]);

    return redirect('profile')->with('success','You have successfully update your password');
  }
}
