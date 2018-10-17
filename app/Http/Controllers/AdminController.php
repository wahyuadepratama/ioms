<?php

namespace App\Http\Controllers;

use App\PengurusPiket;
use App\PiketHarian;
use App\Anggota;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct(){ //----------------------------------------------------------------- construct()
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function getAllUser(){ //----------------------------------------------------------------- getAllUser()
      $users = Anggota::join('roles','roles.id','=','anggota.id_role')
              ->select('roles.*','anggota.*')
              ->get();
      $deletedUsers = Anggota::onlyTrashed()->get();
      return view('admin/user-management', ['users' => $users, 'deletedUsers'=>$deletedUsers]);
    }

    public function deleteUser($id){ //----------------------------------------------------------------- deleteUser($id)
      $user = Anggota::find($id);
      $user->delete();
      return back()->with('success','You have successfully block user');
    }

    public function restoreUser($id){ //----------------------------------------------------------------- restoreUser($id)
      $restore = Anggota::withTrashed()->where('id',$id);
      $restore->restore();
      return back()->with('success','You have successfully restore user');
    }

    public function showJadwalPiket($id){ //----------------------------------------------------------------- showJadwalPiket($id)
      $cek = Anggota::find($id);
      if($cek->id_role != 1){
        if($cek->id_role == 2){
          $piketHarian = PengurusPiket::select('pengurus_piket.*')
                      ->where('pengurus_piket.id_anggota','=',$id)
                      ->first();
          $akumulasi = ($piketHarian->total_denda + $piketHarian->denda_lain) - $piketHarian->sudah_dibayar;
          return view('admin/user-management-config', ['piketHarian' => $piketHarian, 'anggota' => $cek, 'akumulasi' => $akumulasi]);
        }else if($cek->id_role == 3){
          return view('admin/user-management-config', ['anggota' => $cek]);
        }
      }else{
        return back()->with('success','Maaf user ini adalah Admin');
      }
    }

    public function storeJadwalPiket(Request $request){ //----------------------------------------------------------------- storeJadwalPiket($request)
      PengurusPiket::where('id_anggota', $request->id)->update([
                        'jadwal_piket' => $request->jadwal_piket,
                        'denda_lain' => $request->denda_lain,
                        'sudah_dibayar' => $request->sudah_dibayar
                      ]);
      return redirect('user-management')->with('success','Kamu Berhasil Mengubah Jadwal Piket');
    }

    public function resetPassword($id){ //----------------------------------------------------------------- resetPassword
      $tes = Anggota::where('id', $id)
              ->update(['password' => bcrypt('123456'), ]);

      return redirect('user-management')->with('success','Reset password berhasil dilakukan!');
    }

    public function changeRole(Request $request, $id){ //----------------------------------------------------------------- chageRole
      if($request->role == "none"){
        return back()->with('success','Pilih role option dengan benar!');
      }else{
        Anggota::where('id', $id)->update([
          'id_role' => $request->role,
        ]);

        if($request->role == 2){
          PengurusPiket::create([
              'id_anggota' => $id,
              'jadwal_piket' => "Sunday",
              'total_denda' => 0,
              'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
          ]);
        }
        if($request->role == 3){
          $user = PengurusPiket::where('id_anggota',$id)->first();
          $user->delete();
        }
        return redirect('user-management')->with('success','Kamu Berhasil Mengganti Role User');
      }
    }

    public function indexPiketHarian()
    {
      $piketHarian = PiketHarian::join('pengurus_piket','pengurus_piket.id','=','piket_harian.id_pengurus_piket')
                    ->join('anggota','anggota.id','=','pengurus_piket.id_anggota')
                    ->select('anggota.*','pengurus_piket.*','piket_harian.*','piket_harian.created_at as tanggal_piket','piket_harian.id as id_piket_harian')
                    ->get();

      return view('admin.admin-history-piket')->with('piketHarian',$piketHarian);
    }

    public function updatePiketHarian(Request $request)
    {
      PiketHarian::where('id',$request->id)->update([
                    'keterangan' => $request->keterangan,
                    'denda' => $request->denda
                  ]);
      return back()->with('success','Berhasil mengubah history piket');   
    }

}
