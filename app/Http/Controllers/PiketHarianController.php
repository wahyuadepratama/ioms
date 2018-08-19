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

    public function __construct(){ //----------------------------------------------------------------- construct()
        $this->middleware('auth');
        $this->middleware('pengurus');
    }

    public function index(){ // -------------------------------------------------------- index()
      $data = PengurusPiket::join('anggota','anggota.id','=','pengurus_piket.id_anggota')
            ->where('anggota.id_role','=',2)
            ->get();
      event(new EventPiket());
      return $this->checkStatusPiket('admin/piket-harian', 'piket', 'tidak piket','sudah piket')->with('data', $data);
    }

    protected function checkStatusPiket($redirect,$statusIfPiket,$statusIfNotPiket,$statusAfterAbsen){ // --------------------- checkStatusPiket()
      $configurasi = \Config::get('ioms.piket.harian');
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
            if($date->hour < $configurasi['jam-mulai-piket']){ $denda = 0; }
            elseif($date->hour == $configurasi['jam-mulai-piket'] && $date->minute <= $configurasi['menit-tambahan-mulai-piket']){ $denda = $configurasi['denda-on-time']; }
            elseif($date->hour <= 10){ $denda = $configurasi['denda-satu-jam']; }
            elseif($date->hour <= 11){ $denda = $configurasi['denda-dua-jam']; }
            elseif($date->hour <= 12){ $denda = $configurasi['denda-tiga-jam']; }
            elseif ($date->hour <= 13){ $denda = $configurasi['denda-empat-jam']; }
            elseif($date->hour <= 14){ $denda = $configurasi['denda-lima-jam']; }
            elseif($date->hour <= 15){ $denda = $configurasi['denda-enam-jam']; }
            else{ $denda = $configurasi['denda-diatas-enam-jam']; }

            return view($redirect,['denda'=>$denda,'pengurus_piket'=>$data->id])->with('status',$statusIfPiket);
          }
        }
      }
      return view($redirect)->with('status',$statusIfNotPiket);
    }

    public function piket($denda, $id, Request $request){ // -------------------------------------------------------- piket()
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

    protected function update_total_denda($id,$denda){ // -------------------------------------------------------- update_total_denda()
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
