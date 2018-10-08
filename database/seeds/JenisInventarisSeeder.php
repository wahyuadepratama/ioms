<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JenisInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('jenis_inventaris')->insert([
        [
          'id_jenis' => "1",
          'nama_jenis' => "Meja",
          'keterangan_jenis' => "Milik HMSI",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'id_jenis' => "2",
          'nama_jenis' => "Kursi",
          'keterangan_jenis' => "Dipinjam dari jurusan",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ]
      ]);
    }
}
