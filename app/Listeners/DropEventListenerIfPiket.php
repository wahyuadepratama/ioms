<?php

namespace App\Listeners;

use App\Events\DropEventPiket;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class DropEventListenerIfPiket
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
     * @param  DropEventPiket  $event
     * @return void
     */
    public function handle(DropEventPiket $event)
    {
        DB::unprepared("DROP EVENT IF EXISTS dendaPiket".$event->id_pengurus_piket);
        DB::unprepared("DROP EVENT IF EXISTS updateTotalDenda".$event->id_pengurus_piket);        
    }
}
