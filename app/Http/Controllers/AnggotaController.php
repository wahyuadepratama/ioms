<?php

namespace App\Http\Controllers;

use App\Role;
use App\Anggota;
use Carbon\Carbon;
use App\PengurusPiket;
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
    if(Auth::user()->id_role == 2){
      $data = PengurusPiket::where('id_anggota',Auth::user()->id)->first();
      $denda = ($data->denda_lain + $data->total_denda) - $data->sudah_dibayar;
    }else{
      $denda = 0;
    }
    return view('admin.profile',['anggota'=>$anggota,'denda'=>$denda]);
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

  public function validatorEmail(array $data)
  {
    return Validator::make($data, [
        'email' => 'required|string|email|max:191|unique:anggota',
    ]);
  }

  public function store(Request $request){ // ---------------------------------------- store($request)

    if($request->tanggal_lahir){
      $time = $request->tanggal_lahir;
      $date = Carbon::createFromFormat('d/m/Y', $time)->format('Y-d-m');
    }else{
      $date = NULL;
    }

    $getEmailAnggota = Anggota::where("email",$request->email)->where("id",Auth::user()->id)->first();
    if($getEmailAnggota){
      $this->validator($request->all())->validate();
    }else{
      $this->validatorEmail($request->all())->validate();
    }

    if($request->avatar){
      $avatar = Auth::user()->nim.'.jpg';
      // $request->file('avatar')->storeAs('public/images/avatar', $avatar);
      $request->file('avatar')->move('images/avatar', $avatar);

      Anggota::where('id',Auth::user()->id)->update(['avatar'=>$avatar]);
    }

    Anggota::where('id', Auth::user()->id)
            ->update([
                      'nama' => $request->nama,
                      'email' => $request->email,
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
