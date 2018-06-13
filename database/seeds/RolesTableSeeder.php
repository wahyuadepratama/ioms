<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
        [
          'role_name' => "Admin",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'role_name' => "Pengurus",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ],
        [
          'role_name' => "Anggota",
          'created_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
          'updated_at'=> Carbon::now()->setTimezone('Asia/Jakarta'),
        ]
       ]);
    }
}
