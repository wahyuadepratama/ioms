<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PiketHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('piket_harian')->insert([
        [
          'id_pengurus_piket' => 1,
          'denda' => 0,
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ]
      ]);
    }
}
