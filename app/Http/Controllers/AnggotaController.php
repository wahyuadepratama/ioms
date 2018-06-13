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
          'no_anggota' => 'max:10',
          'avatar' => 'mimes:jpeg,jpg,png|max:1000',
      ]);

  }

  public function store(Request $request){

    $this->validator($request->all())->validate();

    if($request->avatar){
      $avatar = Auth::user()->nim.'.jpg';
      $request->file('avatar')->storeAs('public/avatar', $avatar);
      Anggota::where('id',Auth::user()->id)->update(['avatar'=>$avatar]);
    }

    Anggota::where('id', Auth::user()->id)
            ->update([
                      'nama' => $request->nama,
                      'no_anggota' => $request->no_anggota,
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
