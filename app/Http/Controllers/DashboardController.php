<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengurusPiket;
use App\Inventaris;
use App\Peminjaman;
use Carbon\Carbon;
use App\Peminjam;
use App\Anggota;
use App\Role;

class DashboardController extends Controller
{
  public function __construct(){ //---------------------------------------- construct()
      $this->middleware('auth');
  }

  public function index(){ // ---------------------------------------- index()
    $conf = \Config::get('ioms.dashboard.nim');

    $all = Anggota::all()->count();
    $admin = Anggota::all()->where('id_role','=',1)->count();
    $pengurus = Anggota::all()->where('id_role','=',2)->count();
    $anggota = Anggota::all()->where('id_role','=',3)->count();
    $_admin = number_format(($admin/$all * 100),1);
    $_pengurus = number_format(($pengurus/$all * 100),1);
    $_anggota = number_format(($anggota/$all * 100),1);

    $all = Anggota::select('nim')->get();
    for($x = intval(substr($conf['angkatanTermuda'],2,3));$x >= intval(substr($conf['angkatanTertua'],2,3));$x--){
      $nim[$x] = 0;
      foreach ($all as $key){
        if($key->nim){
          if(substr($key->nim,0,2) == strval($x)){
            $nim[$x]++;
          }
        }
      }
    }

    $piketHarian = PengurusPiket::join('anggota','anggota.id','=','pengurus_piket.id_anggota')
          ->where('anggota.id_role','=',2)
          ->where('pengurus_piket.total_denda','!=', NULL)
          ->get();

    return view('admin/dashboard',[
      'admin'=>$admin,
      'pengurus'=>$pengurus,
      'anggota'=>$anggota,
      '_admin'=>$_admin,
      '_pengurus'=>$_pengurus,
      '_anggota'=>$_anggota,
      'nim'=>$nim,
      'piketHarian'=>$piketHarian

    ]);
  }
}
