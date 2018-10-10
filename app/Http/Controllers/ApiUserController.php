<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PengurusPiket;
use App\PiketHarian;
use Carbon\Carbon;
use App\Anggota;

class ApiUserController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['nim' => $request->username, 'password' => $request->password])){
            $user = Auth::user();
            $user = $user->toArray();
            $user = array_map('strval', $user);

            if($user['id_role'] === "1"){
              return response()->json([
                'status' => 'gagal login',
                'error' => 'true',
                'error_msg'=>'Kamu tidak bisa login disini!'
              ]);
            }

            return response()->json([
              'status' => 'login success',
              'error' => 'false',
              'user' => $user
            ]);
        }
        else{
            return response()->json([
              'status' => 'gagal login',
              'error' => 'true',
              'error_msg'=>'Username atau Password Kamu Salah!'
            ]);
        }
    }

    public function checkPiket(Request $request)
    {
      $getUser            = PengurusPiket::where("id_anggota",(int)$request->id_user)->first();
      $allPiketToday      = PengurusPiket::where('jadwal_piket',$request->today)->get();
      $today              = $request->today;
      // $absen              = $request->status;
      $date               = Carbon::now()->setTimezone('Asia/Jakarta');

      if($getUser == NULL){
        return response()->json([
          'error' => 'true',
          'error_msg'=>'Kamu tidak punya jadwal piket disini!'
        ]);
      }else{
        $allPiketHarianById = PiketHarian::where("id_pengurus_piket",$getUser->id)->get();
      }

      if($getUser->jadwal_piket != $today){ // tidak piket hari ini
        return response()->json([
          'error' => 'true',
          'error_msg'=>'Kamu tidak piket hari ini!'
        ]);
      }

      if($getUser->jadwal_piket == $today){

        if($date->hour < 8 | $date->hour > 17){
          return response()->json([
            'error' => 'false',
            'error_msg'=>'Saat ini bukan periode pengambilan absen!'
          ]);
        }

        foreach($allPiketToday as $piket){
          $dataPiketHarian = PiketHarian::where('id_pengurus_piket',$piket->id)->get();
          $runEvent = "true";
          foreach($dataPiketHarian as $key){
            if($key->created_at->toDateString() == Carbon::now()->setTimezone('Asia/Jakarta')->toDateString()){
              $runEvent = "false";
            }
          }
          if($runEvent == "true"){
            $this->createEventPagiSore($piket->id_anggota);
          }
        }

        if($allPiketHarianById == NULL){
          PiketHarian::create([
              'id_pengurus_piket' => $getUser->id,
              'denda' => 15000,
              'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
          ]);
          $allPiketHarianById = PiketHarian::where("id_pengurus_piket",$getUser->id)->get();
        }

        if($allPiketHarianById != NULL){

          $this->destroyEvent($getUser->id_anggota);

          $found = 'false';
          foreach ($allPiketHarianById as $x){
            if($x->created_at->toDateString() == Carbon::now()->setTimezone('Asia/Jakarta')->toDateString()){
              $found = 'true';
            }
          }

          if($found == 'false'){
            PiketHarian::create([
                'id_pengurus_piket' => $getUser->id,
                'denda' => 15000,
                'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
            ]);
            $allPiketHarianById = PiketHarian::where("id_pengurus_piket",$getUser->id)->get();
          }

          foreach ($allPiketHarianById as $x){
            if($x->created_at->toDateString() == Carbon::now()->setTimezone('Asia/Jakarta')->toDateString()){
              if($date->hour <= 11 && $date->hour >= 7){
                if($x->piket_pagi == NULL){
                  $dendaNow = $x->denda - 10000;
                  $x->denda = $dendaNow;
                  $x->piket_pagi = "true";
                  $x->save();
                  $this->updateTotalDenda($dendaNow,$request->id_user);

                  return response()->json([
                    'error' => 'false',
                    'error_msg'=>'Absen pagi berhasil diambil! Terima Kasih ^_^'
                  ]);

                }else{
                  return response()->json([
                    'error' => 'false',
                    'error_msg'=>'Absensi hanya bisa dilakukan 1x'
                  ]);
                }
              }
              elseif($date->hour > 12 && $date->hour < 15){
                return response()->json([
                  'error' => 'false',
                  'error_msg'=>'Maaf, absen pagi sudah tidak bisa diambil!'
                ]);
              }
              elseif($date->hour >= 15 && $date->hour < 18){
                if($x->piket_sore == NULL){
                  if($x->piket_pagi == "true"){
                    $dendaNow = $x->denda - 5000;
                  }else{
                    $dendaNow = $x->denda - 10000;
                  }
                  $x->denda = $dendaNow;
                  $x->piket_sore = "true";
                  $x->save();
                  $this->updateTotalDenda($dendaNow,$request->id_user);

                  return response()->json([
                    'error' => 'false',
                    'error_msg'=>'Absen sore berhasil diambil! Terima Kasih ^_^'
                  ]);

                }else{
                  return response()->json([
                    'error' => 'false',
                    'error_msg'=>'Absensi hanya bisa dilakukan 1x'
                  ]);
                }
              }
              else{
                return response()->json([
                  'error' => 'false',
                  'error_msg'=>'Saat ini bukan periode pengambilan absen!'
                ]);
              }
            }
          }
        }
      }

    }

    public function createEventPagiSore($id_user)
    {
      $deadline = \Config::get('ioms.piket.harian.waktu-absen-sore');
      $dendaMaksimal = \Config::get('ioms.piket.harian.denda-pagi-sore');

      $dt = Carbon::now()->setTimezone('Asia/Jakarta')->toDateString()." ".$deadline;
      DB::statement("SET GLOBAL event_scheduler='ON' ");
      DB::unprepared("
        CREATE EVENT IF NOT EXISTS eventPagiSore".$id_user."
          ON SCHEDULE AT '".$dt."'
        DO
          INSERT INTO piket_harian(id_pengurus_piket,keterangan,denda,created_at)
          VALUES(".$id_user.", 'saya tidak piket hari ini', ".$dendaMaksimal.", NOW());
      ");
      DB::unprepared("
        CREATE EVENT IF NOT EXISTS updateTotalDenda".$id_user."
          ON SCHEDULE AT '".$dt."'
        DO
          UPDATE pengurus_piket
          SET total_denda = (SELECT SUM(piket_harian.denda) FROM piket_harian WHERE id_pengurus_piket = ".$id_user."), updated_at = now()
          WHERE id = ".$id_user.";
      ");
    }

    public function destroyEvent($id)
    {
      DB::unprepared("DROP EVENT IF EXISTS eventPagiSore".$id);
      // DB::unprepared("DROP EVENT IF EXISTS updateTotalDenda".$id);
    }

    public function updateTotalDenda($denda,$id_user)
    {
      $getUser = PengurusPiket::where("id_anggota",(int)$id_user)->first();
      $getUser->total_denda = $getUser->total_denda + $denda;
      $getUser->save();
    }

    public function tesaja()
    {
      return $getUser = PengurusPiket::where("id_anggota",3)->first();
    }
}
