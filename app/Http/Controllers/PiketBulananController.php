<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\PiketBulanan;
use App\Events\EventPosting;
use App\Events\DropEventPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PiketBulananController extends Controller
{
    public function index(){

      $data = PiketBulanan::join('anggota','anggota.id','=','piket_bulanan.id_anggota')
            ->where('anggota.id_role','=',2)
            ->get();
      event(new EventPosting());
      return $this->checkStatusPiket()->with('data',$data);
    }

    public function piket(){

      PiketBulanan::where('id_anggota','=',Auth::user()->id)
              ->update([
                'status' => "sudah piket",
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
              ]);
      event(new DropEventPosting(Auth::user()->id));
      return back()->with('success','Terima kasih telah mengambil absen');
    }


    protected function checkStatusPiket(){

      $cek = PiketBulanan::where('id_anggota','=',Auth::user()->id)->get();

      if($cek->all() != NULL){
        foreach ($cek as $data) {
          if($data->status == "belum piket"){
            $month = Carbon::now()->setTimezone('Asia/Jakarta')->format('F');
            if($data->jadwal_posting == $month){
              return view('admin.piket-bulanan',['keterangan'=>$data->status])->with('status','piket');
            }else{
              return view('admin.piket-bulanan')->with('status','tidak piket');
            }
          }elseif($data->status == "sudah piket"){
            return view('admin.piket-bulanan')->with('status','sudah piket');
          }elseif($data->status == "didenda"){
            return view('admin.piket-bulanan')->with('status','didenda');
          }
        }
      }else{
        return view('admin.piket-bulanan');
      }
    }

}
