<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnggotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('anggota')->insert([
        [
          'nim' => "1511521024",
          'nama' => "Wahyu Ade Pratama",
          'alamat' => "Jala utama II blok j2 no 12, Mata Air, Padang Selatan",
          'email' => 'wahyuadepratama@hmsiunand.com',
          'password' => '$2y$10$.7hqO3OKindL4AA.nxVTb.2QJGo/mpPBNjDc2Uc800T0HTmrl9wGa',
          'id_role' => 1,
          'remember_token' => str_random(40),
          'created_at'=> Carbon::now(),
          'updated_at'=> Carbon::now(),
        ],
        [
          'nim' => "1511521013",
          'nama' => "Yolanda Parawita",
          'alamat' => "Lubuk buaya",
          'email' => 'yolandaparawita@hmsiunand.com',
          'password' => '$2y$10$.7hqO3OKindL4AA.nxVTb.2QJGo/mpPBNjDc2Uc800T0HTmrl9wGa',
          'id_role' => 2,
          'remember_token' => str_random(40),
          'created_at'=> Carbon::now(),
          'updated_at'=> Carbon::now(),
        ],
       ]);
    }
}
