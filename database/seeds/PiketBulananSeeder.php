<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PiketBulananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('piket_bulanan')->insert([
        [
          'id_anggota' => 2,
          'status' => "belum piket",
          'jadwal_posting' => "June",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'id_anggota' => 3,
          'status' => "belum piket",
          'jadwal_posting' => "July",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'id_anggota' => 4,
          'status' => "belum piket",
          'jadwal_posting' => "August",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'id_anggota' => 5,
          'status' => "belum piket",
          'jadwal_posting' => "September",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'id_anggota' => 6,
          'status' => "belum piket",
          'jadwal_posting' => "October",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
      ]);
    }
}
