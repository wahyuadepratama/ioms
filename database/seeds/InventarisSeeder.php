<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('inventaris')->insert([
        [
          'nama' => "Meja Kayu",
          'id_jenis' => 1,
          'qty' => 2,
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'nama' => "Kursi Kayu",
          'id_jenis' => 2,
          'qty' => 2,
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ]
      ]);
    }
}
