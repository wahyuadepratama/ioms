<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\PiketBulanan;
use App\Events\EventPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListenerIfPosting
{

    public function __construct(){
        //
    }

    public function handle(EventPosting $event){
      $all = PiketBulanan::all();
      foreach($all as $value){
        $month = Carbon::now()->setTimezone('Asia/Jakarta')->format('F');
        if($value->jadwal_posting == $month && $value->status == "belum piket"){
          $this->query($value->id_anggota);
        }
      }
    }

    protected function query($value){
      $dt = Carbon::now()->addMonth();
      DB::statement("SET GLOBAL event_scheduler='ON' ");
      DB::unprepared("
        CREATE EVENT IF NOT EXISTS dendaPosting".$value."
          ON SCHEDULE AT '".$dt."'
        DO
          UPDATE pengurus_bulanan SET status = 'didenda', updated_at = now() WHERE id_anggota = ".$value.";
      ");
    }
}
