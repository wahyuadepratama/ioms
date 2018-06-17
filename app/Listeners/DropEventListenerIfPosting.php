<?php

namespace App\Listeners;

use App\Events\DropEventPosting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DropEventListenerIfPosting
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
     * @param  DropEventPosting  $event
     * @return void
     */
    public function handle(DropEventPosting $event)
    {
      DB::unprepared("DROP EVENT IF EXISTS dendaPosting".Auth::user()->id);
    }
}
