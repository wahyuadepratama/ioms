<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\PengurusPiket;
use App\PiketHarian;
use App\Events\EventPiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListenerIfNotPiket
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventPiket  $event
     * @return void
     */
    public function handle(EventPiket $event)
    {
      $all = PengurusPiket::all();
      foreach ($all as $value) {
        $today = Carbon::now()->format('l');
        if($value->jadwal_piket == $today){
          // start -- Cek status sudah piket atau belum
          $statusAll = PiketHarian::select('created_at')->where('id_pengurus_piket','=',$value->id)->get();
          if($statusAll->all() == NULL){
            $this->query($value->id);
          }else{
            $countStatus = count($statusAll);
            foreach ($statusAll as $key) {
              if($key->created_at->toDateString() == Carbon::now()->setTimezone('Asia/Jakarta')->toDateString()){
                break;
              }else{
                $countStatus--;
              }
            }
            if($countStatus == 0){
              $this->query($value->id);
            }
          }
        }
        // end -- Cek status sudah piket atau belum
      }
    }

    protected function query($value){

      $deadline = \Config::get('ioms.piket.harian.waktu-piket-terakhir');
      $dendaMaksimal = \Config::get('ioms.piket.harian.denda-piket-maksimal');

      $dt = Carbon::now()->toDateString()." ".$deadline;
      DB::statement("SET GLOBAL event_scheduler='ON' ");
      DB::unprepared("
        CREATE EVENT IF NOT EXISTS dendaPiket".$value."
          ON SCHEDULE AT '".$dt."'
        DO
          INSERT INTO piket_harian(id_pengurus_piket,keterangan,denda,created_at)
          VALUES(".$value.", 'saya tidak piket hari ini', ".$dendaMaksimal.", NOW());
      ");
      DB::unprepared("
        CREATE EVENT IF NOT EXISTS updateTotalDenda".$value."
          ON SCHEDULE AT '".$dt."'
        DO
          UPDATE pengurus_piket
          SET total_denda = (SELECT SUM(piket_harian.denda) FROM piket_harian WHERE id_pengurus_piket = ".$value."), updated_at = now()
          WHERE id = ".$value.";
      ");

    }
}
