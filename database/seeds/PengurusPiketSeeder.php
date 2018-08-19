<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PengurusPiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengurus_piket')->insert([
          [
            'id_anggota' => 2,
            'jadwal_piket' => "Monday",
            'total_denda' => 0,
            'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
            'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          ],
          [
            'id_anggota' => 3,
            'jadwal_piket' => "Tuesday",
            'total_denda' => 0,
            'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
            'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          ],
          [
            'id_anggota' => 4,
            'jadwal_piket' => "Wednesday",
            'total_denda' => 0,
            'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
            'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          ],
          [
            'id_anggota' => 5,
            'jadwal_piket' => "Thursday",
            'total_denda' => 0,
            'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
            'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          ],
          [
            'id_anggota' => 6,
            'jadwal_piket' => "Saturday",
            'total_denda' => 0,
            'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
            'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          ],          
        ]);
    }
}
