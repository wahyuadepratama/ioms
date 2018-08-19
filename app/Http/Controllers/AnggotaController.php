<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Anggota;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
  public function __construct(){ //---------------------------------------- construct()
      $this->middleware('auth');
  }

  public function profile(){ // ---------------------------------------- profile()
    $anggota = Anggota::join('roles','roles.id','=','anggota.id_role')
              ->select('roles.*','anggota.*')
              ->where('anggota.id','=', Auth::user()->id)
              ->get();
    return view('admin.profile',['anggota'=>$anggota]);
  }

  public function edit(){ // ---------------------------------------- edit()
    $anggota = Anggota::join('roles','roles.id','=','anggota.id_role')
              ->select('roles.*','anggota.*')
              ->where('anggota.id','=', Auth::user()->id)
              ->get();
    return view('admin.profile-edit',['anggota'=>$anggota]);
  }

  public function validator(array $data){ // ---------------------------------------- validator($data)
      return Validator::make($data, [
          'nama' => 'required|string|max:191',
          'no_anggota' => 'max:10',
          'avatar' => 'mimes:jpeg,jpg,png|max:1000',
      ]);
  }

  public function store(Request $request){ // ---------------------------------------- store($request)
    if($request->tanggal_lahir){
      $time = $request->tanggal_lahir;
      $date = Carbon::createFromFormat('d/m/Y', $time)->format('Y-d-m');
    }else{
      $date = NULL;
    }
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
                      'tempat_lahir' =>$request->tempat_lahir,
                      'tanggal_lahir' =>$date,
                      'kutipan' => $request->kutipan,
                    ]);
    return redirect('profile')->with('success','You have successfully update your profile');
  }

  public function validatorPassword(array $data){ // ---------------------------------------- validatorPassword()
    return Validator::make($data, [
        'password' => 'max:191|confirmed|min:6',
    ]);
  }

  public function storePassword(Request $request){ // ---------------------------------------- storePassword()
    $this->validatorPassword($request->all())->validate();
    Anggota::where('id', Auth::user()->id)
            ->update(['password' => bcrypt($request->password), ]);

    return redirect('profile')->with('success','You have successfully update your password');
  }

  public function getAllUser(){ // ---------------------------------------- getAllUser()
    $users = Anggota::join('roles','roles.id','=','anggota.id_role')
              ->select('roles.*','anggota.*')
              ->where('anggota.id_role','!=','1')
              ->get();
    return view('admin.anggota-hmsi',['users'=>$users]);
  }
}
