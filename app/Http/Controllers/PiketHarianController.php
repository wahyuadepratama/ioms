<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\PengurusPiket;
use App\PiketHarian;
use App\Events\EventPiket;
use App\Events\DropEventPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PiketHarianController extends Controller
{

    public function index(){

      $data = PengurusPiket::join('anggota','anggota.id','=','pengurus_piket.id_anggota')
            ->where('anggota.id_role','=',2)
            ->get();
      event(new EventPiket());
      return $this->checkStatusPiket('admin/piket-harian', 'piket', 'tidak piket','sudah piket')->with('data', $data);
    }


    protected function checkStatusPiket($redirect,$statusIfPiket,$statusIfNotPiket,$statusAfterAbsen){

      $cek = PengurusPiket::where('id_anggota', '=' , Auth::user()->id)->get();
      if($cek->all() != NULL){
        foreach ($cek as $data) {
          // start -- Cek status sudah piket atau belum
          $status = PiketHarian::select('created_at')->where('id_pengurus_piket','=',$data->id)->get();
          foreach ($status as $isi) {
            if($isi->created_at->toDateString() == Carbon::now()->setTimezone('Asia/Jakarta')->toDateString())
              return view($redirect)->with('status',$statusAfterAbsen);
          }
          // end -- Cek status sudah piket atau belum
          $today = Carbon::now();
          $today = $today->format('l');

          if($data->jadwal_piket == $today){
            $date = Carbon::now()->setTimezone('Asia/Jakarta');
            if($date->hour < 9){ $denda = 0; }
            elseif($date->hour == 9 && $date->minute <= 15){ $denda = 0; }
            elseif($date->hour <= 10){ $denda = 2000; }
            elseif($date->hour <= 11){ $denda = 4000; }
            elseif($date->hour <= 12){ $denda = 6000; }
            elseif ($date->hour <= 13){ $denda = 8000; }
            elseif($date->hour <= 14){ $denda = 10000; }
            elseif($date->hour <= 15){ $denda = 15000; }
            else{ $denda = 15000; }

            return view($redirect,['denda'=>$denda,'pengurus_piket'=>$data->id])->with('status',$statusIfPiket);
          }
        }
      }
      return view($redirect)->with('status',$statusIfNotPiket);
    }


    public function piket($denda, $id, Request $request){

      PiketHarian::create([
          'id_pengurus_piket' => $id,
          'keterangan' => $request->keterangan,
          'denda' => $denda,
          'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
      ]);
      $this->update_total_denda($id,$denda);
      event(new DropEventPiket($id));
      return back()->with('success','Terima kasih dan selamat piket untuk hari ini ^_^');
    }


    protected function update_total_denda($id,$denda){

      $isi = PengurusPiket::where('id','=',$id)->get();
      foreach ($isi as $isi) {
        $total_denda = $isi->total_denda + $denda;
      }
      PengurusPiket::find($id)
              ->update([
                'total_denda' => $total_denda,
              ]);
    }
}
