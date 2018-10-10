<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengurusPiket extends Model
{
    protected $table = 'pengurus_piket';

    protected $fillable = [
      'id_anggota','jadwal_piket','total_denda','created_at','updated_at','denda_lain','sudah_dibayar'
    ];
}
