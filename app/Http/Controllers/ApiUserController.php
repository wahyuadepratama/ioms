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

        if($date->hour < 7 | $date->hour > 19){
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
            $this->createEventPagiSore($piket->id);
          }
        }

        $allPiketHarianById = PiketHarian::where("id_pengurus_piket",$getUser->id)->get();

        if($allPiketHarianById == NULL){
          PiketHarian::create([
              'id_pengurus_piket' => $getUser->id,
              'denda' => 15000,
              'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
          ]);
          $allPiketHarianById = PiketHarian::where("id_pengurus_piket",$getUser->id)->get();
        }

        if($allPiketHarianById != NULL){

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
              if($date->hour <= 13 && $date->hour >= 7){
                if($x->piket_pagi == NULL){
                  $dendaNow = $x->denda - 10000;
                  $x->denda = $dendaNow;
                  $x->piket_pagi = "true";
                  $x->save();
                  $this->updateTotalDenda($dendaNow,$request->today);

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
              elseif($date->hour > 13 && $date->hour < 15){
                return response()->json([
                  'error' => 'false',
                  'error_msg'=>'Maaf, absen pagi sudah tidak bisa diambil!'
                ]);
              }
              elseif($date->hour >= 15 && $date->hour < 19){
                if($x->piket_sore == NULL){
                  if($x->piket_pagi == "true"){
                    $dendaNow = $x->denda - 5000;
                  }else{
                    $dendaNow = $x->denda - 10000;
                  }
                  $x->denda = $dendaNow;
                  $x->piket_sore = "true";
                  $x->save();
                  $this->updateTotalDenda($dendaNow,$request->today);

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

      PiketHarian::create([
          'id_pengurus_piket' => $id_user,
          'denda' => $dendaMaksimal,
          'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
      ]);
    }

    public function updateTotalDenda($denda,$today)
    {
      $user = PengurusPiket::where('jadwal_piket',$today)->get();

      foreach($user as $getUser){
        DB::unprepared("
          UPDATE pengurus_piket
          SET total_denda = (SELECT SUM(piket_harian.denda) FROM piket_harian WHERE id_pengurus_piket = ".$getUser->id."), updated_at = now()
          WHERE id = ".$getUser->id
        );
      }
    }

    public function tesaja()
    {
      date_default_timezone_set('Asia/Jakarta');
      $target =  mktime(17, 0, 0, 10, 14, 2018);
      $today = time();
      $difference =($target-$today) ;
      $days =(int) ($difference/60) ;
      // return date('F jS, Y g:i:s a', $target);
      // return $days;
      $piketHarian = PengurusPiket::where('id_anggota',2)->first();
      return $piketHarian->id;
    }
}
