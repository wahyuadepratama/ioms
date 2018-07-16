<?php

namespace App\Http\Controllers;

use App\PengurusPiket;
use App\PiketBulanan;
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
      return back()->with('success','You have successfully block user');
    }

    public function restoreUser($id){
      $restore = Anggota::withTrashed()->where('id',$id);
      $restore->restore();
      return back()->with('success','You have successfully restore user');
    }

    public function showJadwalPiket($id){
      $cek = Anggota::find($id);
      if($cek->id_role != 1){
        if($cek->id_role == 2){
          $piketHarian = PengurusPiket::select('pengurus_piket.*')
                      ->where('pengurus_piket.id_anggota','=',$id)
                      ->get();
          $piketBulanan = PiketBulanan::select('piket_bulanan.*')
                      ->where('piket_bulanan.id_anggota','=',$id)
                      ->get();
          return view('admin/user-management-config', ['piketHarian' => $piketHarian, 'piketBulanan' => $piketBulanan, 'anggota' => $cek]);
        }else if($cek->id_role == 3){
          return view('admin/user-management-config', ['anggota' => $cek]);
        }
      }else{
        return back()->with('success','Maaf user ini bukan pengurus HMSI');
      }
    }

    public function storeJadwalPiket(Request $request){
      PengurusPiket::where('id_anggota', $request->id)->update([
                        'jadwal_piket' => $request->jadwal_piket,
                      ]);
      PiketBulanan::where('id_anggota', $request->id)->update([
                        'jadwal_posting' => $request->jadwal_posting,
                      ]);
      return redirect('user-management')->with('success','Kamu Berhasil Mengubah Jadwal Piket');
    }

    public function resetPassword($id){
      $tes = Anggota::where('id', $id)
              ->update(['password' => bcrypt('123456'), ]);

      return redirect('user-management')->with('success','Reset password berhasil dilakukan!');
    }

}
